<?php

namespace App\Http\Controllers;

use App\Models\PricePerMile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PricePerMileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('price_per_mile');
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
            'start_range' => 'required|numeric',
            'end_range' => 'required|numeric',
            'price' => 'required|numeric',
        ]);
    
        $ppm = new PricePerMile();
        $ppm->minimum_range = $request->start_range;
        $ppm->maximum_range = $request->end_range;
        $ppm->price = $request->price;
        $ppm->user_id = Auth::guard('authorized')->user()->id;
        $ppm->save();
    
        return response()->json([
            'success' => true,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(PricePerMile $pricePerMile)
    {
        return view('add_price_per_mile');
    }


    public function getAll()
    {
        $records = PricePerMile::with('authorized_users')->latest()->get();

        $data = $records->map(function ($item) {
            return [
                'range' => $item->minimum_range . ' to ' . $item->maximum_range,
                'price' => $item->price,
                'entered_by' => $item->authorized_users->name  ?? 'Unknown',
                'start_range' => $item->minimum_range,
                'end_range' => $item->maximum_range,
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
     * Show the form for editing the specified resource.
     */
    public function edit(PricePerMile $pricePerMile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'start_range' => 'required|numeric',
            'end_range' => 'required|numeric',
            'price' => 'required|numeric',
        ]);
    
        $ppm = PricePerMile::findOrFail($id);
        $ppm->minimum_range = $request->start_range;
        $ppm->maximum_range = $request->end_range;
        $ppm->price = $request->price;
        $ppm->save();
    
        return response()->json(['success' => true]);
    }


    public function adjustPrices(Request $request)
{
    $percentage = $request->input('percentage');
    
    try {
        
        DB::table('price_per_miles')
            ->update([
                'price' => DB::raw("price + (price * ($percentage / 100))"),
                'updated_at' => now()
            ]);
            
        return response()->json(['success' => true]);
        
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ]);
    }
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $PDid = $id;
        PricePerMile::destroy($PDid);

        return response()->json(['success' => true]);
    }

}
