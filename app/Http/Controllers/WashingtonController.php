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

        $records = Washington::whereNotNull('listed_price')
        ->where('listed_price', '!=', '')
        ->orderBy('created_at', 'desc')
        ->get();

        // $records = DB::table('washington_listing')
        //     ->whereNotNull('listed_price')
        //     ->where('listed_price', '!=', '')
        //     ->orderBy('created_at', 'desc')
        //     ->get();

        $data = $records->map(function ($item) {
            return [
                'origin_location' => $item->originzsc,
                'destination_location' => $item->destinationzsc,
                'vehicle_info' => $item->ymk,
                'price' => $item->listed_price,
                'entery_date' => $item->created_at,
            ];            
        });

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    } catch (\Exception $e) {
        Log::error('Washington Listing Error: ' . $e->getMessage());
        return response()->json(['success' => false, 'message' => 'Server error. Check logs.'], 500);
    } 
    }
}