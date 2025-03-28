<?php

namespace App\Http\Controllers\Api;

use App\Models\Pet;
use App\Models\Ebook;
use Illuminate\Http\Request;
use App\Helpers\StorageHelper;
use Illuminate\Support\Facades\DB;
use App\Helpers\APIResponseMessage;
use App\Http\Controllers\Controller;

class ApiEbookController extends Controller
{

    public function getPetWise(Request $request)
    {
        $validated = $request->validate([
            'pet_id' => 'required|string|exists:pets,id|max:255',
        ]);

        $pet = Pet::select('id', 'name', 'logo')->find($validated['pet_id']);

        if (!$pet) {
            return response()->json([
                'status' => APIResponseMessage::ERROR_STATUS,
                'message' => APIResponseMessage::NODATA,
            ], 404);
        }

        $petData = [
            'id' => $pet->id,
            'name' => $pet->name,
            'logoUrl' => $pet->logo ? (new StorageHelper('petimges', $pet->logo))->getUrl() : null,
        ];

        $ebooks = Ebook::where('pet_id', $validated['pet_id'])
                    ->where('status', 'Y')
                    ->where('user_id', auth('sanctum')->user()->id)
                    ->select('id', 'title', 'attachment','description') 
                    ->get()
                    ->map(function ($ebook) {
                        return [
                            'id' => $ebook->id,
                            'title' => $ebook->title,
                            'description' => $ebook->description,
                            'attachmentUrl' => $ebook->attachment ? (new StorageHelper('e-book', $ebook->attachment))->getUrl() : null,
                        ];
                    });

        return response()->json([
            'status' => APIResponseMessage::SUCCESS_STATUS,
            'message' => APIResponseMessage::DATAFETCHED,
            'data' => [
                'pet' => $petData,
                'ebooks' => $ebooks,
            ],
        ], 200);
    }

    

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'attachment' => 'nullable|mimes:jpeg,png,jpg,gif,pdf,docx|max:5120',
                'pet_id' => 'required|string|exists:pets,id|max:255',
                'title' => 'required|string|max:255',
                'description' => 'required|string',

            ]);
    
            DB::beginTransaction(); 
            
            if ($request->hasFile('attachment')) {
                $imgName = null;
                if ($request->attachment) {
                    $imageExtension = $request->attachment->extension();
                    $imgName = date('m-d-Y_H-i-s') . '-' . uniqid() . '.' . $imageExtension;

                    $uploadUrl = (new StorageHelper('e-book', $imgName, $request->attachment))->uploadImage();
                }
            }
    
            $ebook = new Ebook();
            $ebook->user_id = auth('sanctum')->user()->id ?? null;
            $ebook->pet_id = $request->pet_id ?? null;
            $ebook->attachment = $imgName;
            $ebook->title = $request->title;
            $ebook->description = $request->description;
            $ebook->save();
    
            DB::commit(); 

    
            return response()->json([
                'status' => APIResponseMessage::SUCCESS_STATUS,
                'message' => APIResponseMessage::DATAFETCHED,
                'data'=>$request->description
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
