<?php

namespace App\Http\Controllers\Veterinarian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VeterinarianDashboardController extends Controller
{
    public function index()
    {
        return view('veterinarian.dashboard.index');
    }
}
