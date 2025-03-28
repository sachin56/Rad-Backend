<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\EBookController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RegisteredPetController;



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['middleware' => ['auth']], function () {

    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::group([
            'prefix' => 'customer',
            'as' => 'customer.'
        ], function () {
            Route::get('/', [CustomerController::class, 'index'])->name('index');
            Route::get('/edit/{id}', [CustomerController::class, 'show'])->name('show');
            Route::get('/change-status/{id}', [CustomerController::class, 'activation'])->name('change-status');
            Route::put('/update/{id}', [CustomerController::class, 'update'])->name('update');
            Route::get('get-customer', [CustomerController::class, 'getAjaxtCustomerData'])->name('get-customer');

        });

        Route::prefix('general-management')->group(function () {
            Route::group([
                'prefix' => 'menu',
                'as' => 'menu.'
            ], function () {
                Route::get('/', [MenuController::class, 'index'])->name('index');
                Route::get('/create', [MenuController::class, 'create'])->name('create');
                Route::post('/store', [MenuController::class, 'store'])->name('store');
                Route::get('/edit/{id}', [MenuController::class, 'show'])->name('show');
                Route::get('/get-menu', [MenuController::class, 'getAjaxMenuData'])->name('get-menu');
                Route::put('/update/{id}', [MenuController::class, 'update'])->name('update');
                Route::get('/change-status/{id}', [MenuController::class, 'activation'])->name('change-status');
                Route::delete('/delete/{id}', [MenuController::class, 'destroy'])->name('delete');

            });
        });

        Route::prefix('pet-management')->group(function () {

            Route::group([
                'prefix' => 'registerd-pet',
                'as' => 'registerd-pet.'
            ], function () {
                Route::get('/', [RegisteredPetController::class, 'index'])->name('index');
                Route::get('/edit/{id}', [RegisteredPetController::class, 'show'])->name('show');
                Route::get('/change-status/{id}', [RegisteredPetController::class, 'activation'])->name('change-status');
                Route::get('get-pet', [RegisteredPetController::class, 'getAjaxtPetData'])->name('get-pet');
            });

        });


        Route::group([
            'prefix' => 'e-book',
            'as' => 'e-book.'
        ], function () {
            Route::get('/', [EBookController::class, 'index'])->name('index');
            Route::get('/edit/{id}', [EBookController::class, 'show'])->name('show');
            Route::get('get-e-book', [EBookController::class, 'getAjaxtEbookData'])->name('get-e-book');
        });

    });

});

require __DIR__.'/auth.php';
