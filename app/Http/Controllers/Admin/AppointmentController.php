<?php

namespace App\Http\Controllers\Admin;

use App\Models\Clinics;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Events\LoggableEvent;
use App\Helpers\StorageHelper;
use Illuminate\Support\Facades\DB;
use App\Helpers\APIResponseMessage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Yajra\DataTables\Facades\DataTables;

class AppointmentController extends Controller
{
    public function index()
    {
        return view('veterinarian.appointment.list');
    }

    /**
     * Display the specified customer.
     *
     * This method decrypts the provided customer ID, retrieves the customer
     * along with their roles from the database, and returns the edit view
     * with the customer data and the selected role ID.
     *
     * @param string $id The encrypted customer ID.
     * @return \Illuminate\View\View The view displaying the customer edit form.
     */
    public function show(string $id)
    {
        $appointmentId = decrypt($id);
        $appointment = Appointment::with(['pet', 'appointmentTime', 'location'])->find($appointmentId);

        return view('veterinarian.appointment.edit',[
            'appointment' => $appointment,
        ]);
    }

    public function update(Request $request)
    {
        // dd($request->all());
        try {
            DB::beginTransaction();
            
            $appointment = Appointment::find($request->appointmentId);
            $appointment->appointment_status = $request->appointmentStatus;
            $appointment->updated_by = Auth::id();
            $appointment->save();

            DB::commit();

            // Dispatch Activity Event to log this creation
            Event::dispatch(new LoggableEvent($appointment, 'update'));

            return redirect()->route('appointment.index')->with('success', APIResponseMessage::CREATED);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('appointment.index')->with('error', APIResponseMessage::ERROR_EXCEPTION);
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
    public function getAjaxAppointmentData(Request $request)
    {
        $model = Appointment::query()
            ->with(['pet', 'appointmentTime', 'location'])
            ->where('doctor_id', Auth::guard('veterinarian')->user()->id)
            ->orderBy('id', 'desc');

        return DataTables::eloquent($model)
            ->addIndexColumn()
            ->addColumn('petName', function ($data) {
                return $data->pet?->name ?? 'N/A';
            })
            ->addColumn('appointmentTime', function ($data) {
                return $data->appointmentTime?->time ?? 'N/A';
            })
            ->addColumn('location', function ($data) {
                return $data->location?->location ?? 'N/A';
            })
            ->addColumn('edit', function ($data) {
                $edit_url = route('appointment.show',encrypt($data->id));
                $btn = '<a href="' . $edit_url . '"><i class="fa fa-eye"></i></a>';
                return $btn;
            })
            ->rawColumns(['edit']) 
            ->toJson();
    }


}
