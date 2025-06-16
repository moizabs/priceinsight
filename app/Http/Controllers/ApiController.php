<?php

namespace App\Http\Controllers;

// use App\Models\Order;
use App\Models\PricePerMile;
use App\Models\PricingOptions;
use App\Models\Setting;
use App\Models\SheetDetails;
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
            'id',
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
        $data = SheetDetails::select([
            'id',
            'orderId',
            'originzsc',
            'destinationzsc', 
            'ymk',
            'price',
            'created_at',
            'pstatus',
            'condition',
            'type',
            'transport'
        ])
        // ->whereIn('pstatus', [10, 11, 12, 13, 18])
        ->get();
        return response()->json($data);
    }

//     public function add_api_dispatch_listing_data(Request $request)
// {
//     try {

//         $validatedData = $request->validate([
//             'origin' => 'required|string',
//             'destination' => 'required|string',
//             'trailer_type' => 'required|string',
//             'vehicles' => 'required|array|min:1',
//             'vehicles.*.Vehicle_Type' => 'required|string',
//             'vehicles.*.Inoperable' => 'required|string|in:Yes,No',
//             'vehicles.*.Year' => 'required|string',
//             'vehicles.*.Make' => 'required|string',
//             'vehicles.*.Model' => 'required|string'
//         ]);

//         $insertedRecords = [];

//         foreach ($validatedData['vehicles'] as $vehicle) {
//             $condition = $vehicle['Inoperable'] === 'Yes' ? '2' : '1';
//             $ymk = $vehicle['Year'] . ' ' . $vehicle['Make'] . ' ' . $vehicle['Model'];
            
//             $dp = new SheetDetails();
//             $dp->originzsc = $validatedData['origin'];
//             $dp->destinationzsc = $validatedData['destination'];
//             $dp->ymk = $ymk;
//             $dp->condition = $condition;
//             $dp->type = $vehicle['Vehicle_Type'];
//             $dp->transport = $validatedData['trailer_type'] === 'Open' ? '1' : '2';
//             $dp->pstatus = 10;
//             $dp->save();
            
//             $insertedRecords[] = $dp;
//         }
        
//         return response()->json([
//             'success' => true,
//             'message' => 'Dispatch listing data added successfully',
//             'data' => $insertedRecords,
//             'count' => count($insertedRecords)
//         ], 201);

//     } catch (\Illuminate\Validation\ValidationException $e) {

//         return response()->json([
//             'success' => false,
//             'message' => 'Validation error',
//             'errors' => $e->errors()
//         ], 422);

//     } catch (\Exception $e) {

//         return response()->json([
//             'success' => false,
//             'message' => 'Server error',
//             'error' => $e->getMessage()
//         ], 500);

//     }
// }
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
