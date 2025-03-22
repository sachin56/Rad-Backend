<?php

namespace App\Http\Controllers\Api;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Helpers\APIResponseMessage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ApiRegisterController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:190',
                    Rule::unique('customers', 'email'), // Exclude soft-deleted users
                ],
                'password' => 'required|string|min:6',
                'phone_number' => [
                    'required',
                    'string',
                    Rule::unique('customers', 'phone_number'),
                ],
            ]);
    
            $verificationCode = random_int(1000, 9999);
    
            // Send verification email
            // Mail::to($validated['email'])->send(new ApiEmailVerificationMail($verificationCode, $validated['name']));
    
            // Create new customer
            $customer = Customer::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'phone_number' => $validated['phone_number'],
            ]);
    
            // $role = ApiRole::where('name', 'free')->first();
    
            // if ($role) {
            //     $customer->roles()->attach($role->id);
            // } else {
            //     return response()->json([
            //         'status' => APIResponseMessage::ERROR_STATUS,
            //         'message' => APIResponseMessage::DATAFETCHEDFAILED,
            //     ], 404);
            // }
    
            $token = $customer->createToken('authToken')->plainTextToken;
    
            // Event::dispatch(new ApiLoggableEvent($customer, 'created'));

            // Notify user
            // $userId = $customer->id;
            // $usersWithRole1 = User::whereHas('roles', function ($query) {
            //     $query->where('id', 1);  
            // })->get();
            
            // if (isset($usersWithRole1) && count($usersWithRole1) > 0) {
            //     foreach ($usersWithRole1 as $user) {
            //         $url = route('customer.show', encrypt($userId)); 
            //         $user->notify(new CutomerCreateSuccessful($validated['name'], $url));
            //     }
            // }
    
            return response()->json([
                'status' => APIResponseMessage::SUCCESS_STATUS,
                'message' => APIResponseMessage::DATAFETCHED,
                'data' => $customer->id,
                'token' => $token,
            ], 200);
    
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => APIResponseMessage::ERROR_STATUS,
                'message' => APIResponseMessage::DATAFETCHEDFAILED,
                'errors' => $e->errors(),
            ], 422);
    
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => APIResponseMessage::ERROR_STATUS,
                'message' => APIResponseMessage::DATAFETCHEDFAILED,
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
