<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\PricePerMileController;
use App\Http\Controllers\PricingOptionsController;
use App\Http\Controllers\StateExceptionsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\priceinsightController;
use App\Http\Controllers\VehicleTypeSettingController;
use App\Http\Controllers\ZipCodeExceptionsController;
use App\Http\Middleware\UserMiddleware as AuthorizedGuardMiddleware;
use Illuminate\Support\Facades\Route;



// Create Account
Route::get('/signup-account', [UserController::class, 'index'])->name('signup.account');
Route::post('/create-account', [UserController::class, 'create_account'])->name('create.account');


// Before Authorized 
Route::middleware('guest:authorized')->group(function () {
    Route::get('/', function () {
        return view('Auth.login');
    })->name('index');

    Route::post('/login', [UserController::class, 'login_submit'])->name('login.submit');
});


// After Authorized 
Route::middleware([AuthorizedGuardMiddleware::class])->group(function () {
    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/logout', [UserController::class, 'logout'])->name('logout');

    // Price Per Mile
    Route::get('/price-per-mile', [PricePerMileController::class, 'index'])->name('price.per.mile');
    Route::get('/add-price-per-mile', [PricePerMileController::class, 'show'])->name('add.price.per.mile');
    Route::post('/store-price-per-mile', [PricePerMileController::class, 'store'])->name('store.price.per.mile');
    Route::get('/get-price-per-mile', [PricePerMileController::class, 'getAll'])->name('get.price.per.mile');
    Route::post('/price-per-mile/update/{id}', [PricePerMileController::class, 'update']);
    Route::post('/adjust-prices', [PricePerMileController::class, 'adjustPrices'])->name('adjust.price.per.mile');
    // Route::post('/reset-prices', [PricePerMileController::class, 'resetPrices'])->name('reset.price.per.mile');
    // Route::delete('/price-per-mile/delete/{id}', [PricePerMileController::class, 'destroy']);

    // Pricing Options
    Route::get('/pricing-options', [PricingOptionsController::class, 'index'])->name('pricing.options');
    Route::post('/add-pricing-options', [PricingOptionsController::class, 'store'])->name('add.pricing.options');
    
    
    // State Exceptions
    Route::get('/state-exceptions', [StateExceptionsController::class, 'index'])->name('state.exceptions');
    Route::post('/add-state-exceptions', [StateExceptionsController::class, 'store'])->name('add.state.exceptions');
    Route::get('/get-state-exceptions', [StateExceptionsController::class, 'getAll'])->name('get.all.state.exceptions');


    // ZipCode Exceptions
    Route::get('/zipcode-exceptions', [ZipCodeExceptionsController::class, 'index'])->name('zipcode.exceptions');
    Route::post('/add-zipcode-exceptions', [ZipCodeExceptionsController::class, 'store'])->name('add.zipcode.exceptions');
    Route::get('/get-zipcode-exceptions', [ZipCodeExceptionsController::class, 'getAll'])->name('get.all.zipcode.exceptions');


     // Vehicle Type Exceptions
     Route::get('/vehicle-type-settings', [VehicleTypeSettingController::class, 'index'])->name('vehicle.size.settings');
     Route::post('/add-vehicle-type-settings', [VehicleTypeSettingController::class, 'store'])->name('add.vehicle.size.settings');
     Route::get('/get-vehicle-type-settings', [VehicleTypeSettingController::class, 'getAll'])->name('get.all.vehicle.size.settings');


     Route::get('/last-activity', [UserController::class, 'last_Activity'])->name('last.activity');
     Route::get('/price-insight', [PriceInsightController::class, 'index'])->name('price.insight');


    // Route::get('/exceptions-list', function () {
    //     return view('exceptions_list');
    // })->name('exceptions.list');

    Route::get('/vehicle-size-database', function () {
        return view('vehicle_size_database');
    })->name('vehicle.size.database');

    Route::get('/vehicle-size-queue', function () {
        return view('vehicle_size_queue');
    })->name('vehicle.size.queue');

    

});