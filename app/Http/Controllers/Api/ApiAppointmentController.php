<?php

namespace App\Http\Controllers\Api;

use App\Models\Pet;
use App\Models\Appointment;
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
                'vetid' => 'required|exists:veterinarians,id',
                'appoimentTime' => 'required|integer|max:255',
                'appoimentLocation' => 'required|string|max:255',
                'petId' => 'required|exists:pets,id',
            ]);
    
            DB::beginTransaction(); 
            
            $appointment = new Appointment();
            $appointment->pet_id = $request->vetid;
            $appointment->doctor_id = $request->appoimentTime;
            $appointment->appointment_time_id = $request->appoimentLocation;
            $appointment->location_id = $request->petId;
            $appointment->save();
    
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
