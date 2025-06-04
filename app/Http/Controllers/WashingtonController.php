<?php

namespace App\Http\Controllers;

use App\Models\SheetDetails;
use App\Models\Washington;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class WashingtonController extends Controller
{
    public function index()
    {
       return view('washington-listing');
    }

    public function getAllWashingtonListing()
{
    try {
        $records = Washington::select([
            'originzsc',
            'destinationzsc', 
            'ymk',
            'listed_price',
            'created_at',
            'pstatus'
        ])
        ->whereNotNull('listed_price')
        ->where('listed_price', '!=', '')
        ->orderBy('created_at', 'desc')
        ->get();

        if ($records->isEmpty()) {
            return response()->json([
                'success' => true,
                'data' => [],
                'message' => 'No records found'
            ]);
        }

        $data = $records->map(function ($item) {
            return [
                'origin_location' => $item->originzsc ?? 'N/A',
                'destination_location' => $item->destinationzsc ?? 'N/A',
                'vehicle_info' => $item->ymk ?? 'N/A',
                'price' => $item->listed_price ?? '0.00',
                'status' => match($item->pstatus) {
                    0 => 'New',
                    1 => 'Interested',
                    2 => 'FollowMore',
                    3 => 'AskingLow',
                    4 => 'NotInterested',
                    5 => 'NoResponse',
                    6 => 'TimeQuote',
                    7 => 'PaymentMissing',
                    8 => 'Booked',
                    9 => 'Listed',
                    10 => 'Scheduled',
                    11 => 'Pickup',
                    12 => 'Delivered',
                    13 => 'Completed',
                    14 => 'Cancelled',
                    18 => 'OnApproval',
                    19 => 'CancelOnApproval',
                    15 => 'Deleted',
                    16 => 'OwesMoney',
                    17 => 'CarrierUpdate',
                    default => 'Unknown'
                },
                'entery_date' => optional($item->created_at)->toDateTimeString() ?? 'N/A',
            ];            
        });

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
        
    } catch (\Exception $e) {
        Log::error('Washington Listing Error: ' . $e->getMessage());
        Log::error($e->getTraceAsString());
        return response()->json([
            'success' => false, 
            'message' => 'Server error: ' . $e->getMessage()
        ], 500);
    } 
}


    public function dispatchListing()
    {
       return view('washington-dispatch-listing');
    }


    public function getAllDispatchListing()
{
    try {
        $records = SheetDetails::select([
            'originzsc',
            'destinationzsc', 
            'ymk',
            'listed_price',
            'price',
            'condition',
            'type',
            'transport',
            'user_id',
            'created_at',
            'pstatus'
        ])
        ->whereNotNull('price')
        ->where('price', '!=', '')
        ->orderBy('created_at', 'desc')
        ->with('authorized_user')
        ->get();

        if ($records->isEmpty()) {
            return response()->json([
                'success' => true,
                'data' => [],
                'message' => 'No records found'
            ]);
        }

        $data = $records->map(function ($item) {
            return [
                'origin_location' => $item->originzsc ?? 'N/A',
                'destination_location' => $item->destinationzsc ?? 'N/A',
                'vehicle_info' => $item->ymk ?? 'N/A',
                'price' => $item->listed_price ?? '0.00',
                'dispatch_price' => $item->price ?? '0.00',
                'type' => $item->type ?? 'Unknown',
                'condition' => match($item->condition) {
                    '1' => 'Operable',
                    '2' => 'Inoperable',
                    default => 'Unknown'
                },
                'transport' => match($item->transport) {
                    '1' => 'Open',
                    '2' => 'Enclosed',
                    default => 'Unknown'
                },
                'status' => match($item->pstatus) {
                    0 => 'New',
                    1 => 'Interested',
                    2 => 'FollowMore',
                    3 => 'AskingLow',
                    4 => 'NotInterested',
                    5 => 'NoResponse',
                    6 => 'TimeQuote',
                    7 => 'PaymentMissing',
                    8 => 'Booked',
                    9 => 'Listed',
                    10 => 'Scheduled',
                    11 => 'Pickup',
                    12 => 'Delivered',
                    13 => 'Completed',
                    14 => 'Cancelled',
                    18 => 'OnApproval',
                    19 => 'CancelOnApproval',
                    15 => 'Deleted',
                    16 => 'OwesMoney',
                    17 => 'CarrierUpdate',
                    default => 'Unknown'
                },
                'entery_date' => optional($item->created_at)->toDateTimeString() ?? 'N/A',
            ];            
        });

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
        
    } catch (\Exception $e) {
        Log::error('Dispatch Listing Error: ' . $e->getMessage());
        Log::error($e->getTraceAsString());
        return response()->json([
            'success' => false, 
            'message' => 'Server error: ' . $e->getMessage()
        ], 500);
    } 
}



public function dispatchListingPriceAdd(Request $request)
    {
        $request->validate([
            'origin_location' => 'required',
            'destination_location' => 'required',
            'vehicle_year' => 'required',
            'vehicle_make' => 'required',
            'vehicle_model' => 'required',
            'vehicle_type' => 'required',
            'vehicle_condition' => 'required',
            'trailer_type' => 'required',
            'dispatch_price' => 'required',
        ]);
    
        $dp = new SheetDetails();
        $dp->originzsc = $request->origin_location;
        $dp->destinationzsc = $request->destination_location;
        $dp->ymk = $request->vehicle_year . ' ' . $request->vehicle_make . ' ' . $request->vehicle_model;
        $dp->condition = $request->vehicle_condition;
        $dp->type = $request->vehicle_type;
        $dp->transport = $request->trailer_type;
        $dp->pstatus = 10;
        $dp->price = $request->dispatch_price;
        $dp->user_id = Auth::guard('authorized')->user()->id;
        $dp->save();
    
        return response()->json([
            'success' => true,
        ]);
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

}