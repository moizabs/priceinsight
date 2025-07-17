<?php

namespace App\Http\Controllers;

use App\Models\Freight_Listing;
use Illuminate\Http\Request;

class FreightListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function api_freight_listing_data()
    {
        $data = Freight_Listing::get();
        return response()->json($data);
    }


    public function add_api_freight_listing_data(Request $request)
    {
        try {

            $validatedData = $request->validate([
                'origin' => 'required|string',
                'destination' => 'required|string',
                'trailer_type' => 'required|string',
                'load_type' => 'required|string',
                'freight_width' => 'nullable',
                'freight_length' => 'nullable',
            ]);

            $freight_record = new Freight_Listing();
            $freight_record->origin_location = $validatedData['origin'];
            $freight_record->destination_location = $validatedData['destination'];
            $freight_record->trailer_type = $validatedData['trailer_type'];
            $freight_record->load_type = $validatedData['load_type'];
            $freight_record->freight_width = $validatedData['freight_width'];
            $freight_record->freight_length = $validatedData['freight_length'];
            $freight_record->save();

            return response()->json([
                'success' => true,
                'message' => 'Freight Listing data added successfully!',
                'data' => $freight_record,
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {

            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Server error',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function price_check_freight_listing_data(Request $request)
    {
        $data = Freight_Listing::where('origin_location', $request->origin)
        ->where('destination_location', $request->destination)
        ->where('trailer_type', $request->trailer_type)
        ->where('load_type', $request->load_type)
        ->get();
        return response()->json($data);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Freight_Listing $freight_Listing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Freight_Listing $freight_Listing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Freight_Listing $freight_Listing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Freight_Listing $freight_Listing)
    {
        //
    }
}
