<?php

namespace App\Http\Controllers\Admin;

use App\Models\Clinics;
use App\Models\Veterinarian;
use Illuminate\Http\Request;
use App\Events\LoggableEvent;
use App\Helpers\StorageHelper;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use App\Helpers\APIResponseMessage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ClinicsRequest;
use Illuminate\Support\Facades\Event;

class DoctorController extends Controller
{
    /**
     * Display the clinics view for the admin panel.
     *
     * This method is responsible for returning the view that displays
     * the clinics information in the admin panel.
     *
     * @return \Illuminate\View\View The view for the admin clinics page.
     */
    public function index()
    {
        return view('admin.veterinarian.doctor.doctor');
    }

    /**
     * Toggle the activation status of a customer.
     *
     * This method finds a customer by the provided request ID and toggles their activation status.
     * If the customer is currently active, their status is set to inactive and an email is sent to notify them.
     * If the customer is currently inactive, their status is set to active and an email is sent to notify them.
     * An event is dispatched to log the status change.
     *
     * @param \Illuminate\Http\Request $request The request object containing the customer ID.
     * @return \Illuminate\Http\RedirectResponse Redirects to the customer index route with a success message.
     */
    public function activation(Request $request)
    {
        $data =  Veterinarian::find($request->id);

        if ( $data->status == "Y" ) {

            $data->status = 'N';
            $data->save();
            $id = $data->id;

            //send email
            // Mail::to($data->email)->send(new UserAccountSuspendMail($data));

            // Dispatch Activity Event to log this creation
            Event::dispatch(new LoggableEvent($data, 'status-change-inactive'));

            return redirect()->route('doctor.index')->with('success', APIResponseMessage::DEACTIVALE_RECORD);
        } else {
            $data->status = "Y";
            $data->save();
            $id = $data->id;

              //send email
            //   Mail::to($data->email)->send(new UserAccountActivateMail($data));

            // Dispatch Activity Event to log this creation
            Event::dispatch(new LoggableEvent($data, 'status-change-active'));

            return redirect()->route('doctor.index')->with('success', APIResponseMessage::ACTIVATE_RECORD);
        }

    }

    /**
     * Retrieve menu data for DataTables via AJAX.
     *
     * @param \Illuminate\Http\Request $request The incoming request instance.
     * @return \Illuminate\Http\JsonResponse JSON response containing the menu data.
     *
     * This method performs the following actions:
     * - Queries the Menu model with no eager-loaded relationships and orders by 'id' in descending order.
     * - Uses DataTables to format the query results.
     * - Adds an index column to the DataTables results.
     * - Edits the 'clinicsName' column to display the clinics's name.
     * - Edits the 'logo' column to display the clinics's logo using a partial view.
     * - Adds an 'activation' column with a status icon and a link to change the status.
     * - Adds an 'action' column with action buttons using a partial view.
     */

    public function getAjaxVeterinarianData(Request $request)
    {
        $model = Veterinarian::query()->with([])->orderBy('id', 'desc');

        return DataTables::eloquent($model)
            ->addIndexColumn()
            ->editColumn('name', function ($data) {
                return $data['name'];
            })
            ->editColumn('email', function ($data) {
                return $data['email'];
            })
            ->addColumn('activation', function($data){
                if ( $data->status == "Y" )
                    $status ='fa fa-check';
                else
                    $status ='fa fa-backspace';

                    $btn = '<a href="' . route('doctor.change-status', ['id' =>$data->id]) . '"><i class="' . $status . '"></i></a>';

                return $btn;
            })
            ->rawColumns(['activation'])
            ->toJson();
    }
}
