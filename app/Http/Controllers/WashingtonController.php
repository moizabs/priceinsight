<?php

namespace App\Http\Controllers;

use App\Models\Washington;
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
                'created_at'
            ])
            ->whereNotNull('listed_price')
            ->where('listed_price', '!=', '')
            ->orderBy('created_at', 'desc')
            ->get();

        // $records = Washington::whereNotNull('listed_price')
        //     ->where('listed_price', '!=', '')
        //     ->orderBy('created_at', 'desc')
        //     ->get();

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
}