<?php

namespace App\Http\Controllers\PetSitter;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Events\LoggableEvent;
use App\Models\PetSitterRequest;
use Illuminate\Support\Facades\DB;
use App\Helpers\APIResponseMessage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Yajra\DataTables\Facades\DataTables;

class PetSitterApprovalController extends Controller
{
    public function index()
    {
        return view('petsitter.approval.menu');
    }

    public function update(Request $request,string $id)
    {
        // dd($request->all());
        try {
            DB::beginTransaction();
            
            $appointment = PetSitterRequest::find($id);
            $appointment->status = $request->checkStatus;
            $appointment->updated_by = Auth::id();
            $appointment->save();

            DB::commit();

            // Dispatch Activity Event to log this creation
            Event::dispatch(new LoggableEvent($appointment, 'update'));

            return redirect()->route('apporoval.index')->with('success', APIResponseMessage::CREATED);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('apporoval.index')->with('error', APIResponseMessage::ERROR_EXCEPTION);
        }
    }


    public function getAjaxPetSitterRequestData(Request $request)
    {
        $model = PetSitterRequest::query()
            ->with(['pet', 'user'])
            ->where('pet_sitter_id', Auth::guard('petsitter')->user()->id)
            ->orderBy('id', 'desc');

        return DataTables::eloquent($model)
            ->addIndexColumn()
            ->editColumn('userName', function ($data) {
                return optional($data->user)->name; // safer access
            })
            ->editColumn('petName', function ($data) {
                return optional($data->pet)->name; // safer access
            })
            ->addColumn('note', function ($data) {
                return Str::words(optional($data->user)->note, 10, '...');   
            })
            ->addColumn('action', function ($menu) {
                return view('petsitter.approval.partials.brand._action', compact('menu'))->render();
            })
            ->rawColumns(['activation', 'action']) // important!
            ->toJson();
    }

}
