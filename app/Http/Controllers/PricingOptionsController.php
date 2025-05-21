<?php

namespace App\Http\Controllers;

use App\Models\PricingOptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PricingOptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pricing_options = PricingOptions::first();
        return view('pricing_options', compact('pricing_options'));
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
            'vehicle_size' => 'required|in:Yes,No',
            'in_operable' => 'nullable',
            'enclosed' => 'nullable',
            'deposit_amount' => 'nullable',
            'DepositHide' => 'nullable',
        ]);

        $pricingOption = PricingOptions::first();
        $pricingOption->disabled_vehicle = $request->vehicle_size;
        $pricingOption->in_operable = $request->in_operable;
        $pricingOption->enclosed_transport = $request->enclosed;
        $pricingOption->deposit_amount = $request->deposit_amount;
        $pricingOption->hide_deposit = $request->DepositHide;
        $pricingOption->user_id = Auth::guard('authorized')->user()->id;
        $pricingOption->save();

        return response()->json([
            'success' => true,
            'message' => 'Vehicle type option saved successfully.',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(PricingOptions $pricingOptions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PricingOptions $pricingOptions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PricingOptions $pricingOptions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PricingOptions $pricingOptions)
    {
        //
    }
}
