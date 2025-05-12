<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PricePerMile;
use App\Models\PricingOptions;
use App\Models\Setting;
use App\Models\StateExceptions;
use App\Models\ZipCodeExceptions;
use App\Models\VehicleTypeSetting;

class ApiController extends Controller
{
    
    public function api_price_per_miles()
    {
        $data = PricePerMile::all();
        return response()->json($data);
    }

    public function api_pricing_options()
    {
        $data = PricingOptions::all();
        return response()->json($data);
    }

    public function api_state_exceptions()
    {
        $data = StateExceptions::all();
        return response()->json($data);
    }

    public function api_vehicle_type_settings()
    {
        $data = VehicleTypeSetting::all();
        return response()->json($data);
    }

    public function api_zip_code_exceptions()
    {
        $data = ZipCodeExceptions::all();
        return response()->json($data);
    }

    public function api_setting_data()
    {
        $data = Setting::all();
        return response()->json($data);
    }
}
