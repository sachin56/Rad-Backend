<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use App\Models\Veterinarian;
use Illuminate\Http\Request;
use App\Events\LoggableEvent;
use App\Helpers\StorageHelper;
use App\Models\DoctorBookingTime;
use App\Http\Requests\MenuRequest;
use Illuminate\Support\Facades\DB;
use App\Helpers\APIResponseMessage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\DoctorBookingTimeRquest;

class DoctorTimeController extends Controller
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
        return view('veterinarian.booking_time.time',[
            'doctors'=>$doctors
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DoctorBookingTimeRquest $request)
    {
        try {

            DB::beginTransaction();

            $doctorBookingTime = new DoctorBookingTime();
            $doctorBookingTime->doctor_id = $request->doctorId;
            $doctorBookingTime->time = $request->appointmentTime;
            $doctorBookingTime->created_by = Auth::id();
            $doctorBookingTime->save();

            DB::commit();

            // Dispatch Activity Event to log this creation
            Event::dispatch(new LoggableEvent($doctorBookingTime, 'created'));

            return redirect()->route('booking-time.index')->with('success', APIResponseMessage::CREATED);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('booking-time.index')->with('error', APIResponseMessage::FAIL);
        }
    }


 
    public function update(DoctorBookingTimeRquest $request, string $id)
    {
        try {
           

            DB::beginTransaction();

            // dd($request->all());
            $doctorBookingTime = DoctorBookingTime::find($id);
            $doctorBookingTime->doctor_id = $request->doctorId;
            $doctorBookingTime->time = $request->appointmentTime;
            $doctorBookingTime->updated_by = Auth::id();
            $doctorBookingTime->save();

            DB::commit();

            // Dispatch Activity Event to log this creation
            Event::dispatch(new LoggableEvent($doctorBookingTime, 'update'));

            return redirect()->route('booking-time.index')->with('success', APIResponseMessage::CREATED);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('booking-time.index')->with('error', APIResponseMessage::ERROR_EXCEPTION);
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
        $data =  DoctorBookingTime::find($request->id);

        if ( $data->status == "Y" ) {

            $data->status = 'N';
            $data->save();
            $id = $data->id;

            //send email
            // Mail::to($data->email)->send(new UserAccountSuspendMail($data));

            // Dispatch Activity Event to log this creation
            Event::dispatch(new LoggableEvent($data, 'status-change-inactive'));

            return redirect()->route('booking-time.index')->with('success', APIResponseMessage::DEACTIVALE_RECORD);
        } else {
            $data->status = "Y";
            $data->save();
            $id = $data->id;

              //send email
            //   Mail::to($data->email)->send(new UserAccountActivateMail($data));

            // Dispatch Activity Event to log this creation
            Event::dispatch(new LoggableEvent($data, 'status-change-active'));

            return redirect()->route('booking-time.index')->with('success', APIResponseMessage::ACTIVATE_RECORD);
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
            $menuCategory = DoctorBookingTime::find($id);

            $menuCategory->update(['deleted_by' => Auth::id()]);
            DoctorBookingTime::with([])->find($id)->delete();

            DB::commit();

            // Dispatch Activity Event to log this creation
            Event::dispatch(new LoggableEvent($menuCategory, 'deleted'));

            return redirect()->route('booking-time.index')->with('success', APIResponseMessage::DELETED);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('booking-time.index')->with('error', APIResponseMessage::ERROR_EXCEPTION);

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

    public function getAjaxDoctorBookingTimeData(Request $request)
    {
        $model = DoctorBookingTime::query()->with(['doctor'])->orderBy('id', 'desc');

        return DataTables::eloquent($model)
            ->addIndexColumn()
            ->editColumn('name', function ($data) {
                return $data->doctor->name;
            })
            ->editColumn('time', function ($data) {
                return $data['time'];
            })
            ->addColumn('activation', function($data){
                if ( $data->status == "Y" )
                    $status ='fa fa-check';
                else
                    $status ='fa fa-backspace';

                    $btn = '<a href="' . route('booking-time.change-status', ['id' =>$data->id]) . '"><i class="' . $status . '"></i></a>';

                return $btn;
            })
            ->addColumn('action', function ($data) {
                $doctors = Veterinarian::where('status','Y')->get();
                return view('veterinarian.booking_time.partials.time._action', compact('data','doctors'));
            })
            ->rawColumns(['activation'])
            ->toJson();
    }
}
