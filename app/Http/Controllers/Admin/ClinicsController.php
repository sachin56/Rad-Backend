<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use App\Models\Clinics;
use Illuminate\Http\Request;
use App\Events\LoggableEvent;
use App\Helpers\StorageHelper;
use App\Http\Requests\ClinicsRequest;
use Illuminate\Support\Facades\DB;
use App\Helpers\APIResponseMessage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Yajra\DataTables\Facades\DataTables;


class ClinicsController extends Controller
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
        return view('admin.general.clinics');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClinicsRequest $request)
    {
        try {
            $imgName = null;
            if ($request->logo) {
                $imageExtension = $request->logo->extension();
                $originalName = $request->logo->getClientOriginalName();
                $replace = str_replace(' ', '-', strtolower(pathinfo($originalName, PATHINFO_FILENAME)));
                $imgName = $replace . '.' . $imageExtension;
                $uploadUrl = (new StorageHelper('clinics', $imgName, $request->logo))->uploadImage();
            }

            DB::beginTransaction();

            $clinics = new Clinics();
            $clinics->logo = $imgName;
            $clinics->name = $request->name;
            $clinics->created_by = Auth::id();
            $clinics->save();

            DB::commit();

            // Dispatch Activity Event to log this creation
            Event::dispatch(new LoggableEvent($clinics, 'created'));

            return redirect()->route('clinics.index')->with('success', APIResponseMessage::CREATED);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('clinics.index')->with('error', APIResponseMessage::FAIL);
        }
    }


 
    public function update(ClinicsRequest $request, string $id)
    {
        try {
            $clinics = Clinics::find($id);

            if ($request->logo) {
                if ($request->logo != null)
                    (new StorageHelper('clinics', $request->logo))->deleteImage();
                $imageExtension = $request->logo->extension();
                $originalName = $request->logo->getClientOriginalName();
                $replace = str_replace(' ', '-', strtolower(pathinfo($originalName, PATHINFO_FILENAME)));
                $imgName = $replace . '.' . $imageExtension;
                (new StorageHelper('clinics', $imgName, $request->logo))->uploadImage();
            } else {
                $imgName = $clinics->logo;
            }


            DB::beginTransaction();

            $clinics->logo = $imgName;
            $clinics->logo = $imgName;
            $clinics->name = $request->name;
            $clinics->updated_by = Auth::id();
            $clinics->save();

            DB::commit();

            // Dispatch Activity Event to log this creation
            Event::dispatch(new LoggableEvent($clinics, 'update'));

            return redirect()->route('clinics.index')->with('success', APIResponseMessage::CREATED);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('clinics.index')->with('error', APIResponseMessage::ERROR_EXCEPTION);
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
            $clinics = Clinics::find($id);

            $clinics->update(['deleted_by' => Auth::id()]);
            Clinics::with([])->find($id)->delete();

            DB::commit();

            // Dispatch Activity Event to log this creation
            Event::dispatch(new LoggableEvent($clinics, 'deleted'));

            return redirect()->route('clinics.index')->with('success', APIResponseMessage::DELETED);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('clinics.index')->with('error', APIResponseMessage::ERROR_EXCEPTION);

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

    public function getAjaxClinicsData(Request $request)
    {
        $model = Clinics::query()->with([])->orderBy('id', 'desc');

        return DataTables::eloquent($model)
            ->addIndexColumn()
            ->editColumn('name', function ($clinics) {
                return $clinics['name'];
            })
            ->editColumn('logo', function ($clinics) {
                $logoUrl = (new StorageHelper('clinics', $clinics['logo']))->getUrl();
                return view('admin.general.partials.clinics._image', compact('logoUrl'));
            })
            ->addColumn('activation', function($clinics){
                if ( $clinics->status == "Y" )
                    $status ='fa fa-check';
                else
                    $status ='fa fa-backspace';

                    $btn = '<a href="' . route('clinics.change-status', ['id' =>$clinics->id]) . '"><i class="' . $status . '"></i></a>';

                return $btn;
            })
            ->addColumn('action', function ($clinics) {
                $clinics->logoUrl = (new StorageHelper('clinics', $clinics['logo']))->getUrl();
                return view('admin.general.partials.clinics._action', compact('clinics'));
            })
            ->rawColumns(['activation'])
            ->toJson();
    }
}
