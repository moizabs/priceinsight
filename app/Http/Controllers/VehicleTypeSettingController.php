<?php

namespace App\Http\Controllers;

use App\Models\VehicleTypeSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VehicleTypeSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('vehicle_size_settings');
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
        $request->validate([
            'Vehicle_Type' => 'required',
            'Operation_Type' => 'required',
            'Price' => 'required',
        ]);

        VehicleTypeSetting::updateOrCreate(
            [
                'vehicle_type' => $request->Vehicle_Type,
            ],
            [
                'operation_type' => $request->Operation_Type,
                'price' => $request->Price,
                'user_id' => Auth::guard('authorized')->user()->id,
            ]
        );
    
        return response()->json([
            'success' => true,
        ]);
    }


    public function getAll(Request $request)
    {
        $records = VehicleTypeSetting::with('authorized_users')->latest()->get();

        $data = $records->map(function ($item) {
            return [
                'vehicle_type' => $item->vehicle_type,
                'entered_by' => $item->authorized_users->name ?? 'Unknown',
                'operation_type' => $item->operation_type,
                'price' => $item->price,
                'id' => $item->id,
                'entery_date' => $item->created_at,
            ];            
        });

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }



    /**
     * Display the specified resource.
     */
    public function show(VehicleTypeSetting $vehicleTypeSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VehicleTypeSetting $vehicleTypeSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VehicleTypeSetting $vehicleTypeSetting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VehicleTypeSetting $vehicleTypeSetting)
    {
        //
    }
}
