<?php

namespace App\Http\Controllers\PetSitter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PetSitterDashboardController extends Controller
{
    public function index()
    {
        return view('petsitter.dashboard.index');
    }
}
