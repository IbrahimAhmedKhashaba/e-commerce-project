<?php

use App\Http\Controllers\Dashboard\Admin\AdminController;
use App\Http\Controllers\Dashboard\Auth\ResetPasswordController;
use App\Http\Controllers\Dashboard\Auth\AuthController;
use App\Http\Controllers\Dashboard\Brand\BrandController;
use App\Http\Controllers\Dashboard\Category\CategoryController;
use App\Http\Controllers\Dashboard\Role\RoleController;
use App\Http\Controllers\Dashboard\WelcomeController;
use App\Http\Controllers\Dashboard\World\WorldController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;



Route::group(
    [
        'prefix' => LaravelLocalization::setLocale() . '/dashboard',
        'as' => 'dashboard.',
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () { //...

        // ############################# Auth ##################################
        Route::controller(AuthController::class)->group(function () {
            Route::middleware('guest:admin')->group(function () {
                Route::get('login', 'showLoginForm')->name('login.form');
                Route::get('register', 'showRegisterForm')->name('register.form');
                Route::post('login', 'login')->name('login');
            });
            Route::post('logout', 'logout')->name('logout');
        });

        // ############################# Reset Password ##################################
        Route::controller(ResetPasswordController::class)
            ->middleware('guest:admin')
            ->prefix('password')
            ->name('password.')
            ->group(function () {
                Route::get('email', 'getEmail')->name('email');
                Route::post('email', 'send_otp')->name('email.send_otp');
                Route::get('{email}/confirm', 'getConfirmForm')->name('confirm');
                Route::get('{email}/update', 'showUpdateForm')->name('showUpdateForm');
                Route::post('verify', 'verify')->name('verify');
                Route::post('reset', 'reset')->name('reset');
            });


        // ############################# Protected Route ##################################
        Route::group(['middleware' => ['auth:admin', 'can:home']], function () {
            // ############################# Home ##################################
            Route::get('/welcome', [WelcomeController::class, 'index'])->name('welcome');
        });

        // ############################# Roles ##################################
        Route::resource('/roles', RoleController::class);

        // ############################# Admins ##################################
        Route::resource('/admins', AdminController::class)->except(['show']);
        Route::get('/admins/{id}/status', [AdminController::class, 'status'])->name('admins.status');
        Route::get('/admins/{key}/search', [AdminController::class, 'search'])->name('admins.search');


        // ############################# World ##################################
        Route::controller(WorldController::class)
            ->group(function () {
                Route::prefix('countries')->name('countries.')->group(function () {
                    Route::get('/', 'getAllCountries')->name('index');
                    Route::get('/{id}/status', 'changeStatus')->name('status');
                    Route::get('/{id}/governorates', 'getAllGovernorates')->name('governorates.index');
                });

                Route::prefix('governorates')->name('governorates.')->group(function () {
                    Route::get('/{id}/governorate/status', 'changeGovernorateStatus')->name('status');
                    Route::put('/shipping-price', 'ChangeShippingPrice')->name('shipping-price');
                });
            });

        // ############################# Categories ##################################
        Route::resource('/categories', CategoryController::class);
        Route::get('/categories/{id}/status', [CategoryController::class, 'changeStatus'])->name('categories.status');
        Route::get('/categories-all', [CategoryController::class, 'getALl'])->name('categories.all');

        // ############################# Brands ##################################
        Route::resource('/brands', BrandController::class);
    }
);
