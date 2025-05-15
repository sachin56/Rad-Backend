<?php

namespace App\Http\Controllers\Api;

use App\Models\ShopProduct;
use App\Models\ShopCategory;
use Illuminate\Http\Request;
use App\Helpers\StorageHelper;
use App\Helpers\APIResponseMessage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ApiShopProductController extends Controller
{
    public function index(Request $request)
    {
        $validator = Validator::make(['category_id' => $request->category_id], [
            'category_id' => 'required|integer|exists:shop_categories,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => APIResponseMessage::ERROR_STATUS,
                'message' => 'Validation error.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $shopProducts = ShopProduct::select('id', 'category_id','name','description','image','price','quantity','status')
                        ->where('category_id', $request->category_id)
                        ->where('status', 'Y')
                        ->orderBy('id', 'asc') 
                        ->get();

        foreach ($shopProducts as $shopProduct) {
            $shopProduct->logoImageUrl = $shopProduct->image 
                ? (new StorageHelper('shopproduct', $shopProduct->image))->getUrl() 
                : null;

            unset($shopProduct->image);
            unset($shopProduct->status);
            unset($shopProduct->category_id);


        }


        if ($shopProducts->isEmpty()) {
            return response()->json([
                'status' => APIResponseMessage::ERROR_STATUS,
                'message' => APIResponseMessage::NODATA,
            ], 200);
        }

        return response()->json([
            'status' => APIResponseMessage::SUCCESS_STATUS,
            'message' => APIResponseMessage::DATAFETCHED,
            'data' => $shopProducts,
        ], 200);
    }

}
