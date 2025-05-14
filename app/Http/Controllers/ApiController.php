<?php

namespace App\Http\Controllers;

// use App\Models\Order;
use App\Models\PricePerMile;
use App\Models\PricingOptions;
use App\Models\Setting;
use App\Models\StateExceptions;
use App\Models\VehicleTypeSetting;
use App\Models\Washington;
use App\Models\ZipCodeExceptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $data = Setting::get();
        return response()->json($data);
    }
    public function api_listing_data()
    {
        $data = Washington::select([
            'originzsc',
            'destinationzsc', 
            'ymk',
            'listed_price',
            'created_at',
            'pstatus',
            'condition',
            'type',
            'transport'
        ])
        ->whereIn('pstatus', [9, 10, 11, 12, 13, 14, 18, 19])
        ->get();
        return response()->json($data);
    }


    public function api_dispatch_listing_data()
    {
        $data = Washington::select([
            'originzsc',
            'destinationzsc', 
            'ymk',
            'listed_price',
            'created_at',
            'pstatus',
            'condition',
            'type',
            'transport'
        ])
        ->whereIn('pstatus', [10, 11, 12, 13, 18])
        ->get();
        return response()->json($data);
    }
}



// Dispatch
//  10 => 'Scheduled',
//                     11 => 'Pickup',
//                     12 => 'Delivered',
//                     13 => 'Completed',
//                     18 => 'OnApproval',


// Listed
// 9 => 'Listed',
//                     10 => 'Scheduled',
//                     11 => 'Pickup',
//                     12 => 'Delivered',
//                     13 => 'Completed',
//                     14 => 'Cancelled',
//                     18 => 'OnApproval',
//                     19 => 'CancelOnApproval',
