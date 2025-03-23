<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['middleware' => ['auth']], function () {

    Route::prefix('admin')->group(function () {
        Route::group([
            'prefix' => 'dashboard',
            'as' => 'dashboard.'
        ], function () {
            Route::get('/', [DashboardController::class, 'index'])->name('index');
        });

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
    });

});

require __DIR__.'/auth.php';
