<?php

namespace App\Http\Controllers;

use App\Models\PriceInsight;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PriceInsightController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return view('priceinsight');
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
    public function show(PriceInsight $priceInsight)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PriceInsight $priceInsight)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PriceInsight $priceInsight)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PriceInsight $priceInsight)
    {
        //
    }

    public function getZipCodeLocation(Request $request): JsonResponse
    {
        $data = DB::table('zip_codes')
            ->orWhere('zipcode', 'LIKE', '%' . $request->input('query') . '%')
            ->orWhere('city', 'LIKE', '%' . $request->input('query') . '%')
            ->orWhere('state', 'LIKE', '%' . $request->input('query') . '%')
            ->take(50)->get();
        $ZipCodes = $data->map(function ($row) {
            return $row->city . ', ' . $row->state . ', ' . $row->zipcode;
        });
        return response()->json($ZipCodes);
    }



    public function Calculate_Price_Insight(Request $request) {
        $Origin = $request->Origin;
        $Destination = $request->Destination;
        $Vehicles = $request->Vehicles;
        $TrailerType = $request->TrailerType;
        $Miles = $request->Miles;
    
        $response = Http::get('https://price.shipa1.com/api/price-data');
        $priceData = $response->json();
    
        $matchedPrice = null;
    
        foreach ($priceData as $row) {
            if ($Miles >= $row['minimum_range'] && $Miles <= $row['maximum_range']) {
                $matchedPrice = $row['price'];
                break;
            }
        }
    
        if ($matchedPrice === null) {
            return response()->json([
                'success' => false,
                'message' => 'No pricing found for the given miles range.',
            ]);
        }
    
        $response_po = Http::get('https://price.shipa1.com/api/pricing-options-data');
        $pricingData = $response_po->json();
    
        $response_vt = Http::get('https://price.shipa1.com/api/vehicle-type-data');
        $vehicleData = $response_vt->json();
    
        $vehicleDetails = [];
        $totalVehicleAdjustment = 0;
    
        foreach ($Vehicles as $vehicle) {
            $vehicleAdjustment = 0;
            $vehicleType = $vehicle['Vehicle_Type'];
            $inoperable = $vehicle['Inoperable'];
    
            if ($inoperable == 'Yes') {
                if (is_array($pricingData) && array_key_exists('in_operable', $pricingData)) {
                    $vehicleAdjustment += $pricingData['in_operable'];
                } elseif (isset($pricingData[0]['in_operable'])) {
                    $vehicleAdjustment += $pricingData[0]['in_operable'];
                } else {
                    Log::error("Inoperable pricing key missing in API response");
                }
            }
    
            foreach ($vehicleData as $row) {
                if (strtolower($row['vehicle_type']) == strtolower($vehicleType)) {
                    if ($row['operation_type'] == 'Add') {
                        $vehicleAdjustment += $row['price'];
                    } elseif ($row['operation_type'] == 'Sub') {
                        $vehicleAdjustment -= $row['price'];
                    }
                    break;
                }
            }
    
            $totalVehicleAdjustment += $vehicleAdjustment;
    
            $vehicleDetails[] = [
                'type' => $vehicleType,
                'inoperable' => $inoperable,
                'adjustment' => $vehicleAdjustment
            ];
        }
    
        $matchedPrice += $totalVehicleAdjustment;
    
        if ($TrailerType == 'Enclosed') {
            if (is_array($pricingData) && array_key_exists('enclosed_transport', $pricingData)) {
                $matchedPrice = $matchedPrice * $pricingData['enclosed_transport'];
            } elseif (isset($pricingData[0]['enclosed_transport'])) {
                $matchedPrice = $matchedPrice * $pricingData[0]['enclosed_transport'];
            } else {
                Log::error("Enclosed pricing key missing in API response");
            }
        }
    
        $PricePerMile = $matchedPrice / $Miles;
        $formattedPricePerMile = number_format($PricePerMile, 2);
    
        $confidencePercentage = rand(70, 100);
        $confidenceLevel = $confidencePercentage >= 85 ? 'High Confidence' : 'Moderate Confidence';
    
        return response()->json([
            'success' => true,
            'miles' => $Miles,
            'base_price' => $priceData[0]['price'],
            'price' => $matchedPrice,
            'price_per_mile' => $formattedPricePerMile,
            'vehicle_adjustment_total' => $totalVehicleAdjustment,
            'confidence' => [
                'percentage' => $confidencePercentage,
                'level' => $confidenceLevel
            ]
        ]);
    }


     public function getCoordinates(Request $request) {
      $originZip = $request->input('origin_zip');
      $destinationZip = $request->input('destination_zip');
      
      $originCoords = $this->getLatLon($originZip);
      $destCoords = $this->getLatLon($destinationZip);
      
      if ($originCoords && $destCoords) {
          return response()->json([
              'success' => true,
              'origin' => [
                  'lat' => $originCoords->lat,
                  'lon' => $originCoords->lon
              ],
              'destination' => [
                  'lat' => $destCoords->lat,
                  'lon' => $destCoords->lon
              ]
          ]);
      }
      
      return response()->json(['success' => false]);
  }

  function getLatLon($zip)
   {
      return DB::table('zip_codes')->select('latitude as lat', 'longitude as lon')->where('zipcode', $zip)->first();
   }
}
