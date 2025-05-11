<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\EBookController;
use App\Http\Controllers\Admin\ClinicsController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Veterinarian\LoginController;
use App\Http\Controllers\Admin\RegisteredPetController;
use App\Http\Controllers\veterinarian\RegisterController;
use App\Http\Controllers\Veterinarian\VeterinarianLoginController;
use App\Http\Controllers\veterinarian\VeterinarianRegisterController;
use App\Http\Controllers\Veterinarian\VeterinarianDashboardController;



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

            Route::group([
                'prefix' => 'clinics',
                'as' => 'clinics.'
            ], function () {
                Route::get('/', [ClinicsController::class, 'index'])->name('index');
                Route::get('/create', [ClinicsController::class, 'create'])->name('create');
                Route::post('/store', [ClinicsController::class, 'store'])->name('store');
                Route::get('/edit/{id}', [ClinicsController::class, 'show'])->name('show');
                Route::get('/get-clinics', [ClinicsController::class, 'getAjaxClinicsData'])->name('get-clinics');
                Route::put('/update/{id}', [ClinicsController::class, 'update'])->name('update');
                Route::get('/change-status/{id}', [ClinicsController::class, 'activation'])->name('change-status');
                Route::delete('/delete/{id}', [ClinicsController::class, 'destroy'])->name('delete');

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

Route::prefix('admin/veterinarian')->group(function () {

    Route::get('/dashboard', [VeterinarianDashboardController::class, 'index'])->name('veterinarian.dashboard');
    Route::get('/login', [VeterinarianLoginController::class, 'index'])->name('veterinarian.login');
    Route::post('/login/check', [VeterinarianLoginController::class, 'checklogin'])->name('veterinarian.login.check');
    Route::get('/register', [VeterinarianRegisterController::class, 'index'])->name('veterinarian.register');
    Route::post('/register/store', [VeterinarianRegisterController::class, 'store'])->name('veterinarian.register.store');
    Route::post('/logout', [VeterinarianLoginController::class, 'logout'])->name('veterinarian.logout');


});

require __DIR__.'/auth.php';
