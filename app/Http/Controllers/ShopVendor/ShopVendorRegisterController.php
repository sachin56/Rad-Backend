<?php

namespace App\Http\Controllers\ShopVendor;

use App\Models\ShopVendor;
use App\Models\Veterinarian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\APIResponseMessage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ShopVendorRegisterController extends Controller
{
    public function index()
    {
        return view('shopvendor.auth.register');
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $shopVendor = new ShopVendor();
            $shopVendor->name = $request->name;
            $shopVendor->email = $request->email;
            $shopVendor->password = Hash::make($request->password);
            $shopVendor->save();

            DB::commit();

            return redirect()->route('shop-vendor.login')->with('success', APIResponseMessage::CREATED);
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            return redirect()->route('shop-vendor.login')->with('success', APIResponseMessage::FAIL);
        }
    }
}
