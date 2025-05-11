<?php

namespace App\Http\Controllers\veterinarian;

use App\Models\Clinics;
use App\Models\Veterinarian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\APIResponseMessage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class VeterinarianRegisterController extends Controller
{
    public function index()
    {
        $clinics = Clinics::where('status','Y')->get();

        return view('veterinarian.auth.register',[
            'clinics'=>$clinics
        ]);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $veterinarian = new Veterinarian();
            $veterinarian->name = $request->name;
            $veterinarian->email = $request->email;
            $veterinarian->clinic_id = $request->clinicId;
            $veterinarian->password = Hash::make($request->password);
            $veterinarian->save();

            DB::commit();

            return redirect()->route('veterinarian.login')->with('success', APIResponseMessage::CREATED);
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            return redirect()->route('veterinarian.login')->with('success', APIResponseMessage::FAIL);
        }
    }
}
