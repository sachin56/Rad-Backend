<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\EBookController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\ClinicsController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DoctorTimeController;
use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\RegisteredPetController;
use App\Http\Controllers\Admin\DoctorLocationController;
use App\Http\Controllers\ShopVendor\ShopProductController;
use App\Http\Controllers\ShopVendor\ShopProfileController;
use App\Http\Controllers\PetSitter\PetSitterLoginController;
use App\Http\Controllers\ShopVendor\ShopVendorLoginController;
use App\Http\Controllers\PetSitter\PetSitterApprovalController;
use App\Http\Controllers\PetSitter\PetSitterRegisterController;
use App\Http\Controllers\PetSitter\PetSitterDashboardController;
use App\Http\Controllers\ShopVendor\ShopVendorDasboardController;
use App\Http\Controllers\ShopVendor\ShopVendorRegisterController;
use App\Http\Controllers\Veterinarian\VeterinarianLoginController;
use App\Http\Controllers\ShopVendor\ShopVendorCategoriesController;
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
q
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

        Route::group([
            'prefix' => 'doctor',
            'as' => 'doctor.'
        ], function () {
            Route::get('/', [DoctorController::class, 'index'])->name('index');
            Route::get('/change-status/{id}', [DoctorController::class, 'activation'])->name('change-status');
            Route::get('get-veterinarian', [DoctorController::class, 'getAjaxVeterinarianData'])->name('get-veterinarian');
        });

    });
});

Route::prefix('/veterinarian')->group(function () {

    Route::get('/dashboard', [VeterinarianDashboardController::class, 'index'])->name('veterinarian.dashboard');
    Route::get('/login', [VeterinarianLoginController::class, 'index'])->name('veterinarian.login');
    Route::post('/login/check', [VeterinarianLoginController::class, 'checklogin'])->name('veterinarian.login.check');
    Route::get('/register', [VeterinarianRegisterController::class, 'index'])->name('veterinarian.register');
    Route::post('/register/store', [VeterinarianRegisterController::class, 'store'])->name('veterinarian.register.store');
    Route::post('/logout', [VeterinarianLoginController::class, 'logout'])->name('veterinarian.logout');


    Route::group([
        'prefix' => 'appointment',
        'as' => 'appointment.'
    ], function () {
        Route::get('/', [AppointmentController::class, 'index'])->name('index');
        Route::post('status-change', [AppointmentController::class, 'update'])->name('status-change');
        Route::get('/get-appointment', [AppointmentController::class, 'getAjaxAppointmentData'])->name('get-appointment');
        Route::get('/edit/{id}', [AppointmentController::class, 'show'])->name('show');
    });


    Route::group([
        'prefix' => 'booking-time',
        'as' => 'booking-time.'
    ], function () {
        Route::get('/', [DoctorTimeController::class, 'index'])->name('index');
        Route::get('/create', [DoctorTimeController::class, 'create'])->name('create');
        Route::post('/store', [DoctorTimeController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [DoctorTimeController::class, 'show'])->name('show');
        Route::get('/get-booking-time', [DoctorTimeController::class, 'getAjaxDoctorBookingTimeData'])->name('get-booking-time');
        Route::put('/update/{id}', [DoctorTimeController::class, 'update'])->name('update');
        Route::get('/change-status/{id}', [DoctorTimeController::class, 'activation'])->name('change-status');
        Route::delete('/delete/{id}', [DoctorTimeController::class, 'destroy'])->name('delete');

    });

    Route::group([
        'prefix' => 'booking-location',
        'as' => 'booking-location.'
    ], function () {
        Route::get('/', [DoctorLocationController::class, 'index'])->name('index');
        Route::get('/create', [DoctorLocationController::class, 'create'])->name('create');
        Route::post('/store', [DoctorLocationController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [DoctorLocationController::class, 'show'])->name('show');
        Route::get('/get-booking-location', [DoctorLocationController::class, 'getAjaxDoctorLocationData'])->name('get-booking-location');
        Route::put('/update/{id}', [DoctorLocationController::class, 'update'])->name('update');
        Route::get('/change-status/{id}', [DoctorLocationController::class, 'activation'])->name('change-status');
        Route::delete('/delete/{id}', [DoctorLocationController::class, 'destroy'])->name('delete');
    });
});


Route::prefix('/shop-vendor')->group(function () {

    Route::get('/login', [ShopVendorLoginController::class, 'index'])->name('shop-vendor.login');
    Route::post('/login/check', [ShopVendorLoginController::class, 'checklogin'])->name('shop-vendor.login.check');
    Route::get('/register', [ShopVendorRegisterController::class, 'index'])->name('shop-vendor.register');
    Route::post('/register/store', [ShopVendorRegisterController::class, 'store'])->name('shop-vendor.register.store');
    Route::post('/logout', [ShopVendorLoginController::class, 'logout'])->name('shop-vendor.logout');
    Route::get('/dashboard', [ShopVendorDasboardController::class, 'index'])->name('shop-vendor.dashboard');
    Route::get('/profile', [ShopProfileController::class, 'index'])->name('shop-vendor.profile');
    Route::post('/profile/store', [ShopProfileController::class, 'store'])->name('shop-vendor.profile.store');



    Route::group([
        'prefix' => 'categories',
        'as' => 'categories.'
    ], function () {
        Route::get('/', [ShopVendorCategoriesController::class, 'index'])->name('index');
        Route::get('/create', [ShopVendorCategoriesController::class, 'create'])->name('create');
        Route::post('/store', [ShopVendorCategoriesController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ShopVendorCategoriesController::class, 'show'])->name('show');
        Route::get('/get-categories', [ShopVendorCategoriesController::class, 'getAjaxShopCategoryData'])->name('get-categories');
        Route::put('/update/{id}', [ShopVendorCategoriesController::class, 'update'])->name('update');
        Route::get('/change-status/{id}', [ShopVendorCategoriesController::class, 'activation'])->name('change-status');
        Route::delete('/delete/{id}', [ShopVendorCategoriesController::class, 'destroy'])->name('delete');
    });

    Route::group([
        'prefix' => 'products',
        'as' => 'products.'
    ], function () {
        Route::get('/', [ShopProductController::class, 'index'])->name('index');
        Route::get('/create', [ShopProductController::class, 'create'])->name('create');
        Route::post('/store', [ShopProductController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ShopProductController::class, 'show'])->name('show');
        Route::get('/get-products', [ShopProductController::class, 'getAjaxShopProductData'])->name('get-products');
        Route::put('/update/{id}', [ShopProductController::class, 'update'])->name('update');
        Route::get('/change-status/{id}', [ShopProductController::class, 'activation'])->name('change-status');
        Route::delete('/delete/{id}', [ShopProductController::class, 'destroy'])->name('delete');
    });

});

Route::prefix('/pet-sitter')->group(function () {

    Route::get('/login', [PetSitterLoginController::class, 'index'])->name('pet-sitter.login');
    Route::post('/login/check', [PetSitterLoginController::class, 'checklogin'])->name('pet-sitter.login.check');
    Route::get('/register', [PetSitterRegisterController::class, 'index'])->name('pet-sitter.register');
    Route::post('/register/store', [PetSitterRegisterController::class, 'store'])->name('pet-sitter.register.store');
    Route::post('/logout', [PetSitterLoginController::class, 'logout'])->name('pet-sitter.logout');
    Route::get('/dashboard', [PetSitterDashboardController::class, 'index'])->name('pet-sitter.dashboard');
    Route::get('/profile', [ShopProfileController::class, 'index'])->name('pet-sitter.profile');
    Route::post('/profile/store', [ShopProfileController::class, 'store'])->name('pet-sitter.profile.store');

    Route::group([
        'prefix' => 'apporoval',
        'as' => 'apporoval.'
    ], function () {
        Route::get('/', [PetSitterApprovalController::class, 'index'])->name('index');
        Route::get('/get-apporoval', [PetSitterApprovalController::class, 'getAjaxPetSitterRequestData'])->name('get-apporoval');
        Route::get('/change-status/{id}', [PetSitterApprovalController::class, 'update'])->name('change-status');
    });

});

require __DIR__.'/auth.php';
