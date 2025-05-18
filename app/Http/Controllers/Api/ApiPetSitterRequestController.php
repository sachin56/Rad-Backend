<?php

namespace App\Http\Controllers\Api;

use App\Models\Ebook;
use Illuminate\Http\Request;
use App\Helpers\StorageHelper;
use App\Models\PetSitterRequest;
use Illuminate\Support\Facades\DB;
use App\Helpers\APIResponseMessage;
use App\Http\Controllers\Controller;

class ApiPetSitterRequestController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'pet_id' => 'required|exists:pets,id',
                'note' => 'nullable|string|max:255',
                'pet_sitter_id' => 'required|exists:pet_sitter_requests,id',
            ]);
            $request->merge([
                'user_id' => auth('sanctum')->user()->id ?? null,
            ]);
    
            DB::beginTransaction(); 
            
            $petSitterRequest = new PetSitterRequest();
            $petSitterRequest->user_id = auth('sanctum')->user()->id ?? null;
            $petSitterRequest->pet_id = $request->pet_id ?? null;
            $petSitterRequest->pet_sitter_id = $request->pet_sitter_id ?? null;
            $petSitterRequest->note = $request->note ?? null;
            $petSitterRequest->save();
    
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
