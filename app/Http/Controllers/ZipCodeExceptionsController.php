<?php

namespace App\Http\Controllers;

use App\Models\ZipCodeExceptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ZipCodeExceptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('zipcode_exceptions');
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
            'Route_Type' => 'nullable',
            'Operation_Type' => 'nullable',
            'Origin_ZipCode' => 'nullable',
            'Destination_ZipCode' => 'nullable',
            'ZipCode' => 'nullable',
            'Value' => 'nullable|numeric',
            'Value_Percentage' => 'nullable|numeric',
        ]);
    
        $se = new ZipCodeExceptions();

        if($request->Route_Type == 'Route'){
            $se->origin_zipcode = $request->Origin_ZipCode;
            $se->destination_zipcode = $request->Destination_ZipCode;
        }else if($request->Route_Type == 'Origin'){
            $se->origin_zipcode = $request->ZipCode;
        }else if($request->Route_Type == 'Destination'){
            $se->destination_zipcode = $request->ZipCode;
        }else{
            $se->origin_zipcode = $request->ZipCode;
        }

        $se->route_type = $request->Route_Type;        
        $se->operation_type = $request->Operation_Type;
        $se->value = $request->Value;
        $se->value_percentage = $request->Value_Percentage;
        $se->user_id = Auth::guard('authorized')->user()->id;
        $se->save();
    
        return response()->json([
            'success' => true,
        ]);
    }

    public function getAll()
    {
        $records = ZipCodeExceptions::with('authorized_users')->latest()->get();

        $data = $records->map(function ($item) {
            return [
                'zipcode' => ($item->origin_zipcode && $item->destination_zipcode)
                                ? $item->origin_zipcode . ' -> ' . $item->destination_zipcode
                                : ($item->origin_zipcode ?? $item->destination_zipcode ?? ''),
                'route_type' => $item->route_type,
                'entered_by' => $item->authorized_users->name ?? 'Unknown',
                'operation_type' => $item->operation_type,
                'value' => $item->value,
                'value_percentage' => $item->value_percentage,
                'origin_zipcode' => $item->origin_zipcode,
                'destination_zipcode' => $item->destination_zipcode,
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
    public function show(ZipCodeExceptions $zipCodeExceptions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ZipCodeExceptions $zipCodeExceptions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ZipCodeExceptions $zipCodeExceptions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ZipCodeExceptions $zipCodeExceptions)
    {
        //
    }
}
