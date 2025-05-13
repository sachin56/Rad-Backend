<?php

namespace App\Http\Controllers\Api;

use App\Models\Veterinarian;
use Illuminate\Http\Request;
use App\Helpers\StorageHelper;
use App\Helpers\APIResponseMessage;
use App\Http\Controllers\Controller;

class ApiVeterinarianController extends Controller
{
    public function index()
    {
        $Veterinarians = Veterinarian::with(['clincs'])->where('status', '=','Y')->get();

        foreach($Veterinarians as $Veterinarian)
        {
            // $pet->logoUrl = $pet->logo ? (new StorageHelper('petimges', $pet->logo))->getUrl() : null;
            $Veterinarian->clincName = $Veterinarian->clincs->name;
            
            unset(
                $Veterinarian->clincs,
                $Veterinarian->clinic_id,
                $Veterinarian->status,
                $Veterinarian->created_by,
                $Veterinarian->updated_by,
                $Veterinarian->deleted_by,
                $Veterinarian->deleted_at,
                $Veterinarian->created_at,
                $Veterinarian->updated_at
            );
        }
        
        if ($Veterinarians->isEmpty()) {
            return response()->json([
                'status' => APIResponseMessage::ERROR_STATUS,
                'message' => APIResponseMessage::NODATA,
            ], 404);
        }

        return response()->json([
            'status' => APIResponseMessage::SUCCESS_STATUS,
            'message' => APIResponseMessage::DATAFETCHED,
            'data' => $Veterinarians,
        ], 200);
    }
}
