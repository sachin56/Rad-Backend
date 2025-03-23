<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiMenuController;
use App\Http\Controllers\Api\ApiLoginController;
use App\Http\Controllers\Api\ApiRegisterController;
use App\Http\Controllers\Api\ApiPetRegisterController;

Route::post('/login', [ApiLoginController::class, 'login'])->name('api.login');
Route::post('/register', [ApiRegisterController::class, 'store'])->name('api.register');

Route::middleware(['auth:sanctum'])->group(function () {

    Route::prefix('general-management')->group(function () {

        Route::prefix('menu')->group(function () {
            Route::get('/', [ApiMenuController::class, 'index']);
        });

    });

    Route::prefix('pet-management')->group(function () {

        Route::post('/register', [ApiPetRegisterController::class, 'store']);

    });

});