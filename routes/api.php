<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiLoginController;
use App\Http\Controllers\Api\ApiRegisterController;

Route::post('/login', [ApiLoginController::class, 'login'])->name('api.login');
Route::post('/register', [ApiRegisterController::class, 'store'])->name('api.register');

