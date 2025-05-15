<?php

namespace App\Http\Controllers\ShopVendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShopVendorDasboardController extends Controller
{
    public function index()
    {
        return view('shopvendor.dashboard.index');
    }
}
