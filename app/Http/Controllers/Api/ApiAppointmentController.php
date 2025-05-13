<?php

namespace App\Http\Controllers\Api;

use App\Models\Pet;
use Illuminate\Http\Request;
use App\Helpers\StorageHelper;
use Illuminate\Support\Facades\DB;
use App\Helpers\APIResponseMessage;
use App\Http\Controllers\Controller;

class ApiAppointmentController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'pet_image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
                'name' => 'required|string|max:255',
                'age' => 'required|integer|max:255',
                'breed' => 'required|string|max:255',
                'gender' => 'required|integer|max:255',
                'weight' => 'required|string|max:255',
                'medical_condition' => 'required',
                'addition_note' => 'required',
            ]);
    
            DB::beginTransaction(); 
            
            if ($request->hasFile('pet_image')) {
                $imgName = null;
                if ($request->pet_image) {
                    $imageExtension = $request->pet_image->extension();
                    $imgName = date('m-d-Y_H-i-s') . '-' . uniqid() . '.' . $imageExtension;

                    $uploadUrl = (new StorageHelper('petimges', $imgName, $request->pet_image))->uploadImage();
                }
            }
    
            $pet = new Pet();
            $pet->user_id = auth('sanctum')->user()->id ?? null;
            $pet->name = $validated['name'];
            $pet->age = $validated['age'];
            $pet->breed = $validated['breed'];
            $pet->gender = $validated['gender'];
            $pet->weight = $validated['weight'];
            $pet->medical_condition = $validated['medical_condition'];
            $pet->addition_note = $validated['addition_note'];
            $pet->logo = $imgName;
            $pet->save();
    
            DB::commit(); 

    
            return response()->json([
                'status' => APIResponseMessage::SUCCESS_STATUS,
                'message' => APIResponseMessage::DATAFETCHED,
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
