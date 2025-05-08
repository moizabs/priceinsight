<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PricePerMileController;
use App\Http\Controllers\PricingOptionsController;
use App\Http\Controllers\StateExceptionsController;
use App\Http\Controllers\VehicleTypeSettingController;
use App\Http\Controllers\ZipCodeExceptionsController;

Route::get('/price-data', 'PricePerMileController@api_price_per_miles');