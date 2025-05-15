<?php

namespace App\Http\Controllers\Api;

use App\Models\ShopVendor;
use Illuminate\Http\Request;
use App\Helpers\StorageHelper;
use App\Helpers\APIResponseMessage;
use App\Http\Controllers\Controller;

class ApiShopController extends Controller
{
    public function index()
    {
        $shopVendors = ShopVendor::select('id', 'name','email','address','phone_number','logo','shop_name')
            ->orderBy('id', 'asc') 
            ->get();

        foreach($shopVendors as $shopVendor)
        {
               $shopVendor->logoImageUrl = $shopVendor->logo 
                ? (new StorageHelper('shopproduct', $shopVendor->logo))->getUrl() 
                : null;
            unset(
                $shopVendor->logo,
            );

        }

        if ($shopVendors->isEmpty()) {
            return response()->json([
                'status' => APIResponseMessage::ERROR_STATUS,
                'message' => APIResponseMessage::NODATA,
            ], 200);
        }
    
        return response()->json([
            'status' => APIResponseMessage::SUCCESS_STATUS,
            'message' => APIResponseMessage::DATAFETCHED,
            'data' => $shopVendors,
        ], 200);
    }
}
