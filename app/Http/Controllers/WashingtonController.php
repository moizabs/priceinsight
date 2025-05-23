<?php

namespace App\Http\Controllers;

use App\Models\SheetDetails;
use App\Models\Washington;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
            'created_at',
            'pstatus'
        ])
        ->whereNotNull('price')
        ->where('price', '!=', '')
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
                'dispatch_price' => $item->price ?? '0.00',
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