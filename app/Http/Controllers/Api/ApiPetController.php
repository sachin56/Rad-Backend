<?php

namespace App\Http\Controllers\Api;

use App\Models\Pet;
use Illuminate\Http\Request;
use App\Helpers\StorageHelper;
use App\Helpers\APIResponseMessage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ApiPetController extends Controller
{
    public function index()
    {
        $pets = Pet::where('status', '=','Y')->where('user_id',auth('sanctum')->user()->id)->get();

        foreach($pets as $pet)
        {
            $pet->logoUrl = $pet->logo ? (new StorageHelper('petimges', $pet->logo))->getUrl() : null;
            
            unset(
                $pet->logo,
                $pet->user_id,
                $pet->status,
                $pet->created_by,
                $pet->updated_by,
                $pet->deleted_by,
                $pet->deleted_at,
                $pet->created_at,
                $pet->updated_at
            );
        }
        
        if ($pets->isEmpty()) {
            return response()->json([
                'status' => APIResponseMessage::ERROR_STATUS,
                'message' => APIResponseMessage::NODATA,
            ], 404);
        }

        return response()->json([
            'status' => APIResponseMessage::SUCCESS_STATUS,
            'message' => APIResponseMessage::DATAFETCHED,
            'data' => $pets,
        ], 200);
    }

    public function show(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pet_id' => 'required|integer|exists:pets,id', 
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'status' => APIResponseMessage::ERROR_STATUS,
                'message' => APIResponseMessage::DATAFETCHEDFAILED,
                'errors' => $validator->errors(),
            ], 400);
        }
        
        $pet = Pet::where('status', 'Y')->find($request->pet_id);
    
        if (!$pet) {
            return response()->json([
                'status' => APIResponseMessage::ERROR_STATUS,
                'message' => APIResponseMessage::DATAFETCHEDFAILED,
            ], 404);
        }

        unset(
            $pet->logo,
            $pet->status,
            $pet->user_id,
            $pet->created_by,
            $pet->updated_by,
            $pet->deleted_by,
            $pet->deleted_at,
            $pet->created_at,
            $pet->updated_at
        );
    
        $pet->logoUrl = $pet->logo ? (new StorageHelper('petimges', $pet->logo))->getUrl() : null;
           
        // Return the pet data
        return response()->json([
            'status' => APIResponseMessage::SUCCESS_STATUS,
            'message' => APIResponseMessage::DATAFETCHED,
            'data' => $pet,
        ], 200);
    }

    public function Update(Request $request)
    {
        try {
            $validated = $request->validate([
                'pet_id' => 'required|integer|exists:pets,id', 
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
            $pet =  Pet::find($validated['pet_id']);

            if ($request->hasFile('pet_image')) {
                $imgName = null;
                if ($request->pet_image) {
                    $imageExtension = $request->pet_image->extension();
                    $imgName = date('m-d-Y_H-i-s') . '-' . uniqid() . '.' . $imageExtension;

                    $uploadUrl = (new StorageHelper('petimges', $imgName, $request->pet_image))->uploadImage();
                }
            }else{
                $imgName = $pet->logo;
            }
    
      
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
                'data'=>$pet,
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
