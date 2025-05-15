<?php

namespace App\Http\Controllers\Api;

use App\Models\ShopCategory;
use Illuminate\Http\Request;
use App\Helpers\StorageHelper;
use App\Helpers\APIResponseMessage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ShopCategoryController extends Controller
{
    public function index(Request $request)
    {
        $validator = Validator::make(['shop_id' => $request->shop_id], [
            'shop_id' => 'required|integer|exists:shop_vendors,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => APIResponseMessage::ERROR_STATUS,
                'message' => 'Validation error.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $shopCategories = ShopCategory::select('id', 'name','logo','shop_id')
            ->where('shop_id', $request->shop_id)
            ->where('status', 'Y')
            ->orderBy('id', 'asc') 
            ->get();

        foreach($shopCategories as $shopCategory)
        {
            $shopCategory->logoImageUrl = isset($shopCategory->logo) 
            ? (new StorageHelper('shopcategory', $shopCategory->logo))->getUrl() 
            : null;

            unset(
                $shopCategory->logo,
            );

        }

        if ($shopCategories->isEmpty()) {
            return response()->json([
                'status' => APIResponseMessage::ERROR_STATUS,
                'message' => APIResponseMessage::NODATA,
            ], 200);
        }
    
        return response()->json([
            'status' => APIResponseMessage::SUCCESS_STATUS,
            'message' => APIResponseMessage::DATAFETCHED,
            'data' => $shopCategories,
        ], 200);
    }
}
