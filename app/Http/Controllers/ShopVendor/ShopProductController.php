<?php

namespace App\Http\Controllers\ShopVendor;

use App\Models\ShopProduct;
use App\Models\ShopCategory;
use Illuminate\Http\Request;
use App\Events\LoggableEvent;
use App\Helpers\StorageHelper;
use Illuminate\Support\Facades\DB;
use App\Helpers\APIResponseMessage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\ShopCategoryRequest;

class ShopProductController extends Controller
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
        $categories = ShopCategory::select('id', 'name')
            ->where('shop_id', Auth::guard('shopvendor')->user()->id)
            ->where('status', 'Y')
            ->orderBy('id', 'asc') 
            ->get();
        return view('shopvendor.product.menu',[
            'categories' => $categories,
        ]);
    }

        /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $imgName = null;
            if ($request->logo) {
                $imageExtension = $request->logo->extension();
                $originalName = $request->logo->getClientOriginalName();
                $replace = str_replace(' ', '-', strtolower(pathinfo($originalName, PATHINFO_FILENAME)));
                $imgName = $replace . '.' . $imageExtension;
                $uploadUrl = (new StorageHelper('shopproduct', $imgName, $request->logo))->uploadImage();
            }

            DB::beginTransaction();

            $shopProduct = new ShopProduct();
            $shopProduct->shop_id = Auth::guard('shopvendor')->user()->id;
            $shopProduct->category_id = $request->categoryId;
            $shopProduct->name = $request->name;
            $shopProduct->description = $request->description;
            $shopProduct->image = $imgName;
            $shopProduct->price = $request->price;
            $shopProduct->quantity = $request->quantity;
            $shopProduct->created_by = Auth::guard('shopvendor')->user()->id;
            $shopProduct->save();

            DB::commit();

            // Dispatch Activity Event to log this creation
            Event::dispatch(new LoggableEvent($shopProduct, 'created'));

            return redirect()->route('products.index')->with('success', APIResponseMessage::CREATED);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('products.index')->with('error', APIResponseMessage::FAIL);
        }
    }

    public function update(ShopCategoryRequest $request, string $id)
    {
        try {
            $shopProduct = ShopProduct::find($id);

            if ($request->logo) {
                if ($request->logo != null)
                    (new StorageHelper('shopproduct', $request->logo))->deleteImage();
                $imageExtension = $request->logo->extension();
                $originalName = $request->logo->getClientOriginalName();
                $replace = str_replace(' ', '-', strtolower(pathinfo($originalName, PATHINFO_FILENAME)));
                $imgName = $replace . '.' . $imageExtension;
                (new StorageHelper('shopproduct', $imgName, $request->logo))->uploadImage();
            } else {
                $imgName = $shopProduct->image;
            }

            DB::beginTransaction();

            $shopProduct->shop_id = Auth::guard('shopvendor')->user()->id;
            $shopProduct->category_id = $request->categoryId;
            $shopProduct->name = $request->name;
            $shopProduct->description = $request->description;
            $shopProduct->image = $imgName;
            $shopProduct->price = $request->price;
            $shopProduct->quantity = $request->quantity;
            $shopProduct->created_by = Auth::guard('shopvendor')->user()->id;
            $shopProduct->save();

            DB::commit();

            // Dispatch Activity Event to log this creation
            Event::dispatch(new LoggableEvent($shopProduct, 'update'));

            return redirect()->route('products.index')->with('success', APIResponseMessage::CREATED);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('products.index')->with('error', APIResponseMessage::ERROR_EXCEPTION);
        }
    }

        public function destroy(string $id)
    {
        try {
            DB::beginTransaction();
            $menuCategory = ShopProduct::find($id);

            $menuCategory->update(['deleted_by' => Auth::id()]);
            ShopProduct::with([])->find($id)->delete();

            DB::commit();

            // Dispatch Activity Event to log this creation
            Event::dispatch(new LoggableEvent($menuCategory, 'deleted'));

            return redirect()->route('products.index')->with('success', APIResponseMessage::DELETED);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('products.index')->with('error', APIResponseMessage::ERROR_EXCEPTION);

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
        $data =  ShopProduct::find($request->id);

        if ( $data->status == "Y" ) {

            $data->status = 'N';
            $data->save();
            $id = $data->id;

            //send email
            // Mail::to($data->email)->send(new UserAccountSuspendMail($data));

            // Dispatch Activity Event to log this creation
            Event::dispatch(new LoggableEvent($data, 'status-change-inactive'));

            return redirect()->route('products.index')->with('success', APIResponseMessage::DEACTIVALE_RECORD);
        } else {
            $data->status = "Y";
            $data->save();
            $id = $data->id;

              //send email
            //   Mail::to($data->email)->send(new UserAccountActivateMail($data));

            // Dispatch Activity Event to log this creation
            Event::dispatch(new LoggableEvent($data, 'status-change-active'));

            return redirect()->route('products.index')->with('success', APIResponseMessage::ACTIVATE_RECORD);
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

    public function getAjaxShopProductData(Request $request)
    {
        $model = ShopProduct::query()->with([])->orderBy('id', 'desc');

        return DataTables::eloquent($model)
            ->addIndexColumn()
            ->editColumn('name', function ($menu) {
                return $menu['name'];
            })
            ->editColumn('logo', function ($menu) {
                $logoUrl = (new StorageHelper('shopproduct', $menu['image']))->getUrl();
                return view('shopvendor.product.partials.brand._image', compact('logoUrl'));
            })
            ->addColumn('activation', function($data){
                if ( $data->status == "Y" )
                    $status ='fa fa-check';
                else
                    $status ='fa fa-backspace';

                    $btn = '<a href="' . route('products.change-status', ['id' =>$data->id]) . '"><i class="' . $status . '"></i></a>';

                return $btn;
            })
            ->addColumn('action', function ($menu) {
                $menu->logoUrl = (new StorageHelper('shopproduct', $menu['image']))->getUrl();
                $categories = ShopCategory::select('id', 'name')
                    ->where('shop_id', Auth::guard('shopvendor')->user()->id)
                    ->where('status', 'Y')
                    ->orderBy('id', 'asc') 
                    ->get();
                return view('shopvendor.product.partials.brand._action', compact('menu','categories'));
            })
            ->rawColumns(['activation'])
            ->toJson();
    }
}
