<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Events\LoggableEvent;
use App\Helpers\StorageHelper;
use App\Http\Requests\MenuRequest;
use Illuminate\Support\Facades\DB;
use App\Helpers\APIResponseMessage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Yajra\DataTables\Facades\DataTables;

class MenuController extends Controller
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
        return view('admin.general.menu');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MenuRequest $request)
    {
        try {
            $imgName = null;
            if ($request->logo) {
                $imageExtension = $request->logo->extension();
                $originalName = $request->logo->getClientOriginalName();
                $replace = str_replace(' ', '-', strtolower(pathinfo($originalName, PATHINFO_FILENAME)));
                $imgName = $replace . '.' . $imageExtension;
                $uploadUrl = (new StorageHelper('menucategory', $imgName, $request->logo))->uploadImage();
            }

            $backgroundImgName = null;
            if ($request->backgroundImage) {
                $imageExtension = $request->backgroundImage->extension();
                $originalName = $request->backgroundImage->getClientOriginalName();
                $replace = str_replace(' ', '-', strtolower(pathinfo($originalName, PATHINFO_FILENAME)));
                $backgroundImgName = $replace . '.' . $imageExtension;
                $uploadUrl = (new StorageHelper('menucategory', $backgroundImgName, $request->backgroundImage))->uploadImage();
            }

            DB::beginTransaction();

            $menuCategory = new Menu();
            $menuCategory->logo = $imgName;
            $menuCategory->background_image = $backgroundImgName;
            $menuCategory->order = $request->order;
            $menuCategory->name = $request->name;
            $menuCategory->description = $request->description;
            $menuCategory->created_by = Auth::id();
            $menuCategory->save();

            DB::commit();

            // Dispatch Activity Event to log this creation
            Event::dispatch(new LoggableEvent($menuCategory, 'created'));

            return redirect()->route('menu.index')->with('success', APIResponseMessage::CREATED);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('menu.index')->with('error', APIResponseMessage::FAIL);
        }
    }


 
    public function update(MenuRequest $request, string $id)
    {
        try {
            $menuCategory = Menu::find($id);

            if ($request->logo) {
                if ($request->logo != null)
                    (new StorageHelper('menucategory', $request->logo))->deleteImage();
                $imageExtension = $request->logo->extension();
                $originalName = $request->logo->getClientOriginalName();
                $replace = str_replace(' ', '-', strtolower(pathinfo($originalName, PATHINFO_FILENAME)));
                $imgName = $replace . '.' . $imageExtension;
                (new StorageHelper('menucategory', $imgName, $request->logo))->uploadImage();
            } else {
                $imgName = $menuCategory->logo;
            }

            if ($request->backgroundImage) {
                if ($request->backgroundImage != null)
                    (new StorageHelper('menucategory', $request->backgroundImage))->deleteImage();
                $imageExtension = $request->backgroundImage->extension();
                $originalName = $request->backgroundImage->getClientOriginalName();
                $replace = str_replace(' ', '-', strtolower(pathinfo($originalName, PATHINFO_FILENAME)));
                $backgroundImgName = $replace . '.' . $imageExtension;
                (new StorageHelper('menucategory', $backgroundImgName, $request->backgroundImage))->uploadImage();
            } else {
                $backgroundImgName = $menuCategory->background_image;
            }

            DB::beginTransaction();

            $menuCategory->logo = $imgName;
            $menuCategory->background_image = $backgroundImgName;
            $menuCategory->order = $request->order;
            $menuCategory->name = $request->name;
            $menuCategory->description = $request->description;
            $menuCategory->updated_by = Auth::id();
            $menuCategory->save();

            DB::commit();

            // Dispatch Activity Event to log this creation
            Event::dispatch(new LoggableEvent($menuCategory, 'update'));

            return redirect()->route('menu.index')->with('success', APIResponseMessage::CREATED);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('menu.index')->with('error', APIResponseMessage::ERROR_EXCEPTION);
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
            $menuCategory = Menu::find($id);

            $menuCategory->update(['deleted_by' => Auth::id()]);
            Menu::with([])->find($id)->delete();

            DB::commit();

            // Dispatch Activity Event to log this creation
            Event::dispatch(new LoggableEvent($menuCategory, 'deleted'));

            return redirect()->route('menu.index')->with('success', APIResponseMessage::DELETED);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('menu.index')->with('error', APIResponseMessage::ERROR_EXCEPTION);

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

    public function getAjaxMenuData(Request $request)
    {
        $model = Menu::query()->with([])->orderBy('id', 'desc');

        return DataTables::eloquent($model)
            ->addIndexColumn()
            ->editColumn('name', function ($menu) {
                return $menu['name'];
            })
            ->editColumn('logo', function ($menu) {
                $logoUrl = (new StorageHelper('menucategory', $menu['logo']))->getUrl();
                return view('admin.general.partials.brand._image', compact('logoUrl'));
            })
            ->addColumn('activation', function($data){
                if ( $data->status == "Y" )
                    $status ='fa fa-check';
                else
                    $status ='fa fa-backspace';

                    $btn = '<a href="' . route('menu.change-status', ['id' =>$data->id]) . '"><i class="' . $status . '"></i></a>';

                return $btn;
            })
            ->addColumn('action', function ($menu) {
                $menu->logoUrl = (new StorageHelper('menucategory', $menu['logo']))->getUrl();
                $menu->backgroundUrl = (new StorageHelper('menucategory', $menu['background_image']))->getUrl();

                return view('admin.general.partials.brand._action', compact('menu'));
            })
            ->rawColumns(['activation'])
            ->toJson();
    }
}
