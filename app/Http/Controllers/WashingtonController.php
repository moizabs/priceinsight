<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class WashingtonController extends Controller
{
    public function index()
    {
       return view('washington-listing');
    }

    public function getAllWashingtonListing()
    {
        $records = Order::whereNotNull('listed_price')
            ->where('listed_price', '!=', '')
            ->orderBy('created_at', 'desc')
            ->get();

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
    }
}