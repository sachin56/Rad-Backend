<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiPetController;
use App\Http\Controllers\Api\ApiMenuController;
use App\Http\Controllers\Api\ApiShopController;
use App\Http\Controllers\Api\ApiEbookController;
use App\Http\Controllers\Api\ApiLoginController;
use App\Http\Controllers\Api\ApiRegisterController;
use App\Http\Controllers\Api\ShopCategoryController;
use App\Http\Controllers\Api\ApiAppointmentController;
use App\Http\Controllers\Api\ApiPetRegisterController;
use App\Http\Controllers\Api\ApiShopProductController;
use App\Http\Controllers\Api\ApiVeterinarianController;
use App\Http\Controllers\ShopVendor\ShopProductController;

Route::post('/login', [ApiLoginController::class, 'login'])->name('api.login');
Route::post('/register', [ApiRegisterController::class, 'store'])->name('api.register');

Route::middleware(['auth:sanctum'])->group(function () {

    Route::prefix('general-management')->group(function () {

        Route::prefix('menu')->group(function () {
            Route::post('/', [ApiMenuController::class, 'index']);
        });

    });

    Route::prefix('pet-management')->group(function () {
        Route::post('/get-all-pet', [ApiPetController::class, 'index']);
        Route::post('/show-pet', [ApiPetController::class, 'show']);
        Route::post('/register', [ApiPetRegisterController::class, 'store']);
        Route::post('/update-pet', [ApiPetController::class, 'Update']);
    });

    Route::prefix('e-book')->group(function () {
        Route::post('/', [ApiEbookController::class, 'getPetWise']);
        Route::post('/store', [ApiEbookController::class, 'store']);
    });

    Route::prefix('veterinarian')->group(function () {
        Route::get('/', [ApiVeterinarianController::class, 'index']);
    });

    Route::prefix('appointment')->group(function () {
        Route::post('/store', [ApiAppointmentController::class, 'store']);
    });

    Route::prefix('shop-vendor')->group(function () {
        Route::get('/', [ApiShopController::class, 'index']);
        Route::get('/categories', [ShopCategoryController::class, 'index']);
        Route::get('/product', [ApiShopProductController::class, 'index']);

    });

});