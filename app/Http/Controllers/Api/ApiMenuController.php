<?php

namespace App\Http\Controllers\Api;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Helpers\StorageHelper;
use App\Helpers\APIResponseMessage;
use App\Http\Controllers\Controller;

class ApiMenuController extends Controller
{
    public function index()
    {
        $menucategories = Menu::select('id', 'name','logo','background_image')
            ->where('status', 'Y')
            ->orderBy('order', 'asc') 
            ->get();

        foreach($menucategories as $menucategory)
        {
            $menucategory->logoImageUrl = isset($menucategory->logo) 
            ? (new StorageHelper('menucategory', $menucategory->logo))->getUrl() 
            : null;

            $menucategory->backgroundImageUrl = isset($menucategory->background_image) 
            ? (new StorageHelper('menucategory', $menucategory->background_image))->getUrl() 
            : null;

            unset(
                $menucategory->logo,
                $menucategory->background_image,
            );

        }

        if ($menucategories->isEmpty()) {
            return response()->json([
                'status' => APIResponseMessage::ERROR_STATUS,
                'message' => APIResponseMessage::NODATA,
            ], 200);
        }
    
        return response()->json([
            'status' => APIResponseMessage::SUCCESS_STATUS,
            'message' => APIResponseMessage::DATAFETCHED,
            'data' => $menucategories,
        ], 200);
    }
}
