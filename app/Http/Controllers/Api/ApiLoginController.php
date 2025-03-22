<?php

namespace App\Http\Controllers\Api;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Helpers\StorageHelper;
use App\Helpers\APIResponseMessage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ApiLoginController extends Controller
{
    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'nullable|email',
                'password' => 'required|string',
            ]);
        
            $user = Customer::where(function ($query) use ($request) {
                if ($request->has('email')) {
                    $email = $request->email;
            
                    // First, check for an exact match
                    $query->where('email', $email);
                }
            })->orWhere(function ($query) use ($request) {
                if ($request->has('email')) {
                    $email = $request->email;
            
                    // If no exact match, check for a case-insensitive match
                    $query->whereRaw('LOWER(email) = ?', [strtolower($email)]);
                }
            })->first();
            
            if (!$user) {
                return response()->json([
                    'status' => APIResponseMessage::ERROR_STATUS,
                    'message' => APIResponseMessage::DATAFETCHEDFAILED,
                    'error' => [
                        'message' => 'User not found. Please check your credentials.'
                    ],
                ], 401);
            }

            if ($user->status !== 'Y') {
                return response()->json([
                    'status' => APIResponseMessage::ERROR_STATUS,
                    'message' => APIResponseMessage::DATAFETCHEDFAILED,
                    'error' => [
                        'message' => 'Your account is inactive. Please contact support.'
                    ],
                ], 403);
            }

            if (!Hash::check($request->password, $user->password)) {
                return response()->json([
                    'status' => APIResponseMessage::ERROR_STATUS,
                    'message' => APIResponseMessage::DATAFETCHEDFAILED,
                    'error' => [
                        'message' => 'Incorrect password. Please try again.'
                    ],
                ], 401);
            }

        
            $token = $user->createToken('authToken')->plainTextToken;


            if(isset($user->profile_image)){
                $user->profileImageUrl = (new StorageHelper('customer', $user->profile_image))->getUrl();  
            }else{
                $user->profileImageUrl = null;
            }
            
            $customer = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'phone_number' => $user->phone_number,
            ];
        
            return response()->json([
                'status' => APIResponseMessage::SUCCESS_STATUS,
                'message' => APIResponseMessage::DATAFETCHED,
                'token' => $token,
                'customer' => $customer,
            ], 200);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors
            return response()->json([
                'status' => APIResponseMessage::ERROR_STATUS,
                'message' => APIResponseMessage::DATAFETCHEDFAILED,
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => APIResponseMessage::ERROR_STATUS,
                'message' => APIResponseMessage::DATAFETCHEDFAILED,
                'error' => $e->getMessage(),
            ], 500);
        }
    }    

    public function logout(Request $request)
    {
        // Revoke the user's token
        $request->user()->tokens->each(function($token) {
            $token->delete();
        });

        return response()->json([
            'status' => APIResponseMessage::SUCCESS_STATUS,
            'message' => 'User logged out successfully.'
        ]);
    }
}
