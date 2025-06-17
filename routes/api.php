<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;


Route::get('/price-data', 'ApiController@api_price_per_miles');
Route::get('/pricing-options-data', 'ApiController@api_pricing_options');
Route::get('/state-exceptions-data', 'ApiController@api_state_exceptions');
Route::get('/vehicle-type-data', 'ApiController@api_vehicle_type_settings');
Route::get('/zip-code-exceptions-data', 'ApiController@api_zip_code_exceptions');

Route::get('/setting-data', 'ApiController@api_setting_data');
Route::get('/listing-data', 'ApiController@api_listing_data');
Route::get('/dispatch-listing-data', 'ApiController@api_dispatch_listing_data');
Route::post('/add-dispatch-listing-data', 'ApiController@add_api_dispatch_listing_data');
Route::post('/price-check-dispatch-listing-data', 'ApiController@price_check_dispatch_listing_data');

Route::post('/create-account', 'UserController@create_account');
Route::get('/view-accounts', 'UserController@view_accounts');
Route::delete('/delete-account', 'UserController@delete_accounts');

Route::get('/osrm-proxy', function(Request $request) {
    $url = "http://router.project-osrm.org/route/v1/driving/" . 
           $request->coordinates . 
           "?overview=false&alternatives=true&steps=true";
    
    return Http::get($url)->json();
});