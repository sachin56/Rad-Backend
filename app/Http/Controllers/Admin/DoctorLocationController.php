<?php

namespace App\Http\Controllers\Admin;

use App\Models\Veterinarian;
use Illuminate\Http\Request;
use App\Events\LoggableEvent;
use App\Models\DoctorLocation;
use Illuminate\Support\Facades\DB;
use App\Helpers\APIResponseMessage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\DoctorLocationRequest;

class DoctorLocationController extends Controller
{
    /**
     * Display the brand view for the admin panel.
     *
     * This method is responsible for returning the view that displays
     * the brand information in the admin panel.
     *
     * @return \Illuminate\View\View The view for the admin brand page.
     */
    public function index()
    {
        $doctors = Veterinarian::where('status','Y')->get();
        return view('veterinarian.booking_location.location',[
            'doctors'=>$doctors
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DoctorLocationRequest $request)
    {
        try {

            DB::beginTransaction();

            $doctorBookingTime = new DoctorLocation();
            $doctorBookingTime->doctor_id = $request->doctorId;
            $doctorBookingTime->location = $request->location;
            $doctorBookingTime->created_by = Auth::id();
            $doctorBookingTime->save();

            DB::commit();

            // Dispatch Activity Event to log this creation
            Event::dispatch(new LoggableEvent($doctorBookingTime, 'created'));

            return redirect()->route('booking-location.index')->with('success', APIResponseMessage::CREATED);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('booking-location.index')->with('error', APIResponseMessage::FAIL);
        }
    }


 
    public function update(DoctorLocationRequest $request, string $id)
    {
        try {
           

            DB::beginTransaction();

            // dd($request->all());
            $doctorBookingTime = DoctorLocation::find($id);
            $doctorBookingTime->doctor_id = $request->doctorId;
            $doctorBookingTime->location = $request->location;
            $doctorBookingTime->updated_by = Auth::id();
            $doctorBookingTime->save();

            DB::commit();

            // Dispatch Activity Event to log this creation
            Event::dispatch(new LoggableEvent($doctorBookingTime, 'update'));

            return redirect()->route('booking-location.index')->with('success', APIResponseMessage::CREATED);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('booking-location.index')->with('error', APIResponseMessage::ERROR_EXCEPTION);
        }
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
        $data =  DoctorLocation::find($request->id);

        if ( $data->status == "Y" ) {

            $data->status = 'N';
            $data->save();
            $id = $data->id;

            //send email
            // Mail::to($data->email)->send(new UserAccountSuspendMail($data));

            // Dispatch Activity Event to log this creation
            Event::dispatch(new LoggableEvent($data, 'status-change-inactive'));

            return redirect()->route('booking-location.index')->with('success', APIResponseMessage::DEACTIVALE_RECORD);
        } else {
            $data->status = "Y";
            $data->save();
            $id = $data->id;

              //send email
            //   Mail::to($data->email)->send(new UserAccountActivateMail($data));

            // Dispatch Activity Event to log this creation
            Event::dispatch(new LoggableEvent($data, 'status-change-active'));

            return redirect()->route('booking-location.index')->with('success', APIResponseMessage::ACTIVATE_RECORD);
        }

    }

    /**
     * Remove the specified menu item from storage.
     *
     * @param string $id The ID of the menu item to be deleted.
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Exception If there is an error during the deletion process.
     */
    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();
            $menuCategory = DoctorLocation::find($id);

            $menuCategory->update(['deleted_by' => Auth::id()]);
            DoctorLocation::with([])->find($id)->delete();

            DB::commit();

            // Dispatch Activity Event to log this creation
            Event::dispatch(new LoggableEvent($menuCategory, 'deleted'));

            return redirect()->route('booking-location.index')->with('success', APIResponseMessage::DELETED);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('booking-location.index')->with('error', APIResponseMessage::ERROR_EXCEPTION);

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
     * - Edits the 'brandName' column to display the brand's name.
     * - Edits the 'logo' column to display the brand's logo using a partial view.
     * - Adds an 'activation' column with a status icon and a link to change the status.
     * - Adds an 'action' column with action buttons using a partial view.
     */

    public function getAjaxDoctorLocationData(Request $request)
    {
        $model = DoctorLocation::query()->with(['doctor'])->orderBy('id', 'desc');

        return DataTables::eloquent($model)
            ->addIndexColumn()
            ->editColumn('name', function ($data) {
                return $data->doctor->name;
            })
            ->editColumn('location', function ($data) {
                return $data['location'];
            })
            ->addColumn('activation', function($data){
                if ( $data->status == "Y" )
                    $status ='fa fa-check';
                else
                    $status ='fa fa-backspace';

                    $btn = '<a href="' . route('booking-location.change-status', ['id' =>$data->id]) . '"><i class="' . $status . '"></i></a>';

                return $btn;
            })
            ->addColumn('action', function ($data) {
                $doctors = Veterinarian::where('status','Y')->get();
                return view('veterinarian.booking_location.partials.time._action', compact('data','doctors'));
            })
            ->rawColumns(['activation'])
            ->toJson();
    }
}
