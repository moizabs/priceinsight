<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/pricing-options', function () {
    return view('pricing_options');
})->name('pricing.options');

Route::get('/price-per-mile', function () {
    return view('price_per_mile');
})->name('price.per.mile');

Route::get('/state-exceptions', function () {
    return view('state_exceptions');
})->name('state.exceptions');

Route::get('/zipcode-exceptions', function () {
    return view('zipcode_exceptions');
})->name('zipcode.exceptions');

Route::get('/exceptions-list', function () {
    return view('exceptions_list');
})->name('exceptions.list');

Route::get('/vehicle-size-database', function () {
    return view('vehicle_size_database');
})->name('vehicle.size.database');

Route::get('/vehicle-size-queue', function () {
    return view('vehicle_size_queue');
})->name('vehicle.size.queue');

Route::get('/vehicle-size-settings', function () {
    return view('vehicle_size_settings');
})->name('vehicle.size.settings');

Route::get('/last-activity', function () {
    return view('last_activity');
})->name('last.activity');