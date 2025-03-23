<?php

namespace App\Http\Controllers\Admin;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Events\LoggableEvent;
use Illuminate\Support\Facades\DB;
use App\Helpers\APIResponseMessage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Event;
use Yajra\DataTables\Facades\DataTables;

class CustomerController extends Controller
{
    /**
     * Display a listing of the customers.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.customer.list');
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
        $customerId = decrypt($id);
        $customer = Customer::with([])->find($customerId);

        return view('admin.customer.edit',[
            'customer' => $customer,
        ]);
    }

    /**
     * Update the specified customer in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Exception
     */
    public function update(Request $request, string $id)
    {

        try {
            DB::beginTransaction();

            $customer = Customer::find($id);

            // Update customer details
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->phone_number = $request->phoneNumber;
            $customer->save();


            DB::commit();

            // Dispatch Activity Event to log this update
            Event::dispatch(new LoggableEvent($customer, 'update'));

            return redirect()->route('customer.index')->with('success', APIResponseMessage::UPDATED);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('customer.index')->with('error', APIResponseMessage::ERROR_EXCEPTION);
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
        $data =  Customer::find($request->id);

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

    /**
     * Retrieve customer data for DataTables via AJAX.
     *
     * This method fetches customer data from the database, orders it by descending ID,
     * and formats it for use with DataTables. It includes columns for name, email,
     * phone number, edit button, and activation status.
     *
     * @return \Illuminate\Http\JsonResponse JSON response containing customer data formatted for DataTables.
     */
    public function getAjaxtCustomerData()
    {
        $model = Customer::with([])->orderBy('id', 'desc');

        return DataTables::eloquent($model)
            ->addIndexColumn()
            ->editColumn('name', function ($customer) {
                return $customer['name'];
            })
            ->editColumn('email', function ($customer) {
                return $customer['email'];
            })
            ->editColumn('phone_number', function ($customer) {
                return $customer['phone_number'];
            })
            ->addColumn('edit', function ($customer) {
                $edit_url = route('customer.show',encrypt($customer->id));
                $btn = '<a href="' . $edit_url . '"><i class="fa fa-edit"></i></a>';
                return $btn;
            })
            ->addColumn('activation', function($customer){
                if ( $customer->status == "Y" )
                    $status ='fa fa-check';
                else
                    $status ='fa fa-backspace';

                $btn = '<a href="' . route('customer.change-status', ['id' =>$customer->id]) . '"><i class="' . $status . '"></i></a>';

                return $btn;
            })
            ->rawColumns(['edit','activation'])
            ->toJson();
    }
}
