<?php

namespace App\Http\Controllers\PetSitter;

use App\Models\PetSitter;
use App\Models\ShopVendor;
use Illuminate\Http\Request;
use App\Helpers\StorageHelper;
use Illuminate\Support\Facades\DB;
use App\Helpers\APIResponseMessage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class PetSitterRegisterController extends Controller
{
    public function index()
    {
        return view('petsitter.auth.register');
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $imgName = null;
            if ($request->logo) {
                $imageExtension = $request->logo->extension();
                $originalName = $request->logo->getClientOriginalName();
                $replace = str_replace(' ', '-', strtolower(pathinfo($originalName, PATHINFO_FILENAME)));
                $imgName = $replace . '.' . $imageExtension;
                $uploadUrl = (new StorageHelper('petsitter', $imgName, $request->logo))->uploadImage();
            }

            $petSitter = new PetSitter();
            $petSitter->name = $request->name;
            $petSitter->email = $request->email;
            $petSitter->phone_number = $request->phone_number;
            $petSitter->address = $request->address;
            $petSitter->profile_image = $imgName;
            $petSitter->expirence = $request->experience;
            $petSitter->password = Hash::make($request->password);
            $petSitter->save();

            DB::commit();

            return redirect()->route('shop-vendor.login')->with('success', APIResponseMessage::CREATED);
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            return redirect()->route('shop-vendor.login')->with('success', APIResponseMessage::FAIL);
        }
    }
}
