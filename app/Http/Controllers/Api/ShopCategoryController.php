<?php

namespace App\Http\Controllers\Api;

use App\Models\ShopCategory;
use Illuminate\Http\Request;
use App\Helpers\StorageHelper;
use App\Helpers\APIResponseMessage;
use App\Http\Controllers\Controller;

class ShopCategoryController extends Controller
{
    public function index()
    {
        $shopCategories = ShopCategory::select('id', 'name','logo')
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
