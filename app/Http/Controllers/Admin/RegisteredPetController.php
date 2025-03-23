<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pet;
use Illuminate\Http\Request;
use App\Events\LoggableEvent;
use App\Helpers\APIResponseMessage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Event;
use Yajra\DataTables\Facades\DataTables;

class RegisteredPetController extends Controller
{
    public function index()
    {
        return view('admin.pet.registerd_pet.list');
    }

    public function show(string $id)
    {
        $petId = decrypt($id);
        $pet = Pet::with(['userName'])->find($petId);

        return view('admin.pet.registerd_pet.edit',[
            'pet' => $pet,
        ]);
    }

    public function activation(Request $request)
    {
        $data =  Pet::find($request->id);

        if ( $data->status == "Y" ) {

            $data->status = 'N';
            $data->save();
            $id = $data->id;

            //send email
            // Mail::to($data->email)->send(new UserAccountSuspendMail($data));

            // Dispatch Activity Event to log this creation
            Event::dispatch(new LoggableEvent($data, 'status-change-inactive'));

            return redirect()->route('customer.index')->with('success', APIResponseMessage::DEACTIVALE_RECORD);
        } else {
            $data->status = "Y";
            $data->save();
            $id = $data->id;

              //send email
            //   Mail::to($data->email)->send(new UserAccountActivateMail($data));

            // Dispatch Activity Event to log this creation
            Event::dispatch(new LoggableEvent($data, 'status-change-active'));

            return redirect()->route('customer.index')->with('success', APIResponseMessage::ACTIVATE_RECORD);
        }

    }


    public function getAjaxtPetData()
    {
        $model = Pet::with(['userName'])->orderBy('id', 'desc');

        return DataTables::eloquent($model)
            ->addIndexColumn()
            ->editColumn('username', function ($pet) {
                return $pet->userName->name;
            })
            ->editColumn('petname', function ($pet) {
                return $pet['name'];
            })
            ->editColumn('breed', function ($pet) {
                return $pet['breed'];
            })
            ->addColumn('edit', function ($pet) {
                $edit_url = route('registerd-pet.show',encrypt($pet->id));
                $btn = '<a href="' . $edit_url . '"><i class="fa fa-edit"></i></a>';
                return $btn;
            })
            ->addColumn('activation', function($pet){
                if ( $pet->status == "Y" )
                    $status ='fa fa-check';
                else
                    $status ='fa fa-backspace';

                $btn = '<a href="' . route('registerd-pet.change-status', ['id' =>$pet->id]) . '"><i class="' . $status . '"></i></a>';

                return $btn;
            })
            ->rawColumns(['edit','activation'])
            ->toJson();
    }


}
