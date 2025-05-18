<?php

namespace App\Http\Controllers\ShopVendor;

use App\Models\ShopVendor;
use Illuminate\Http\Request;
use App\Events\LoggableEvent;
use App\Helpers\StorageHelper;
use Illuminate\Support\Facades\DB;
use App\Helpers\APIResponseMessage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;

class ShopProfileController extends Controller
{
    public function index(Request $request)
    {
        return view('shopvendor.profile.shop-profile');
    }

        public function store(Request $request)
    {
        try {
            $shopVendor = ShopVendor::find(Auth::guard('shopvendor')->user()->id);

            if ($request->logo) {
                if ($request->logo != null)
                    (new StorageHelper('shopvendor', $request->logo))->deleteImage();
                $imageExtension = $request->logo->extension();
                $originalName = $request->logo->getClientOriginalName();
                $replace = str_replace(' ', '-', strtolower(pathinfo($originalName, PATHINFO_FILENAME)));
                $imgName = $replace . '.' . $imageExtension;
                (new StorageHelper('shopvendor', $imgName, $request->logo))->uploadImage();
            } else {
                $imgName = $shopVendor->logo;
            }

            DB::beginTransaction();

            $shopVendor->name = $request->name;
            $shopVendor->logo = $imgName;
            $shopVendor->address = $request->address;
            $shopVendor->phone_number = $request->phoneNumber;
            $shopVendor->shop_name = $request->shopname;

            $shopVendor->save();

            DB::commit();

            // Dispatch Activity Event to log this creation
            Event::dispatch(new LoggableEvent($shopVendor, 'update'));

            return redirect()->route('shop-vendor.profile')->with('success', APIResponseMessage::CREATED);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('shop-vendor.profile')->with('error', APIResponseMessage::ERROR_EXCEPTION);
        }
    }
}
