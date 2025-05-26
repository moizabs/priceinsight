<?php

namespace App\Http\Controllers;

use App\Models\PriceInsight;
use Exception;
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
        $checkSetting = Http::get('https://price.shipa1.com/api/setting-data');
        $settingData = $checkSetting->json();

        if (!empty($settingData) && isset($settingData[0]['washington_data']) && $settingData[0]['washington_data'] === 1) {
            $Washington_Yes = 'Washington_Dropdown';
        }else{
            $Washington_Yes = 'No_Washington_Dropdown';
        }

       return view('priceinsight', compact( 'Washington_Yes'));
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


    public function getVehcilModel(Request $request): JsonResponse
    {
        try {
            DB::beginTransaction();

            $data = DB::table('make_models')->where('title', 'LIKE', '%' . $request->input('query') . '%')->get();
            $Makes = $data->map(function ($row) {
                return $row->title;
            });

            DB::commit();

            return response()->json($Makes);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return response()->json(['error' => 'No Request Available'], 500);
        }
    }

    public function getVehcileMake(Request $request): JsonResponse
    {
        try {
            DB::beginTransaction();

            $data = DB::table('makes')->where('title', 'LIKE', '%' . $request->input('query') . '%')->get();
            $Makes = $data->map(function ($row) {
                return $row->title;
            });

            DB::commit();

            return response()->json($Makes);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return response()->json(['error' => 'No Request Available'], 500);
        }
    }

    public function Calculate_Price_Insight(Request $request) 
    {

    $checkSetting = Http::get('https://price.shipa1.com/api/setting-data');
    $settingData = $checkSetting->json();

    if (!empty($settingData) && isset($settingData[0]['washington_data']) && $settingData[0]['washington_data'] === 1) {
    
    $Origin = str_replace(' ', '', $request->Origin);
    $Destination = str_replace(' ', '', $request->Destination);
    $Vehicles = $request->Vehicles;
    $Miles = $request->Miles;
    $Trailer_Type = $request->TrailerType;

    $originParts = explode(',', $Origin);
    $destParts = explode(',', $Destination);
    
    $originCity = trim($originParts[0] ?? '');
    $originState = trim($originParts[1] ?? '');
    $originZip = trim($originParts[2] ?? '');
    
    $destCity = trim($destParts[0] ?? '');
    $destState = trim($destParts[1] ?? '');
    $destZip = trim($destParts[2] ?? '');

    $dispatchFetching = Http::retry(3, 1000)
        ->timeout(60)
        ->get('https://price.shipa1.com/api/dispatch-listing-data');
    $dispatchData = $dispatchFetching->json();

    $listingFetching = Http::retry(3, 1000)
        ->timeout(60)
        ->get('https://price.shipa1.com/api/listing-data');
    $listingData = $listingFetching->json();




    // Dispatch Listing

    $matchedListings2 = [];
    $strictMatchedListings2 = [];
    $defaultMatchedListings2 = [];
    $dispatchMatchLevel = null;
    $vehicleStats2 = [];
    $totalCombinedPrice2 = 0;
    $totalCombinedCount2 = 0;
    $strictMatchesFound2 = false;

    foreach ($Vehicles as $index => $vehicle2) {
        $vehicleStats2[$index] = [
            'vehicle' => $vehicle2,
            'total_price' => 0,
            'count' => 0,
            'average_price' => 0,
            'matches' => [],
            'vehicle_match_level' => null
        ];
    }

    foreach ($dispatchData as $row) {
        $listingOriginParts = explode(',', str_replace(' ', '', $row['originzsc']));
        $listingDestParts = explode(',', str_replace(' ', '', $row['destinationzsc']));
        
        $listingOriginCity = trim($listingOriginParts[0] ?? '');
        $listingOriginState = trim($listingOriginParts[1] ?? '');
        $listingOriginZip = trim($listingOriginParts[2] ?? '');
        
        $listingDestCity = trim($listingDestParts[0] ?? '');
        $listingDestState = trim($listingDestParts[1] ?? '');
        $listingDestZip = trim($listingDestParts[2] ?? '');

        $originMatch = false;
        $destMatch = false;
    
        if (!empty($originZip) && !empty($listingOriginZip) && !empty($destZip) && !empty($listingDestZip)) {
            if (($originZip === $listingOriginZip && $destZip === $listingDestZip) || ($originZip === $listingDestZip && $destZip === $listingOriginZip)) {
                $originMatch = true;
                $destMatch = true;
                $dispatchMatchLevel = 'zip';
            }
        }

        if (!$originMatch && !$destMatch && !empty($originZip) && !empty($destCity)) {
            if ($originZip === $listingOriginZip && strcasecmp($destCity, $listingDestCity) === 0) {
                $originMatch = true;
                $destMatch = true;
                $dispatchMatchLevel = $dispatchMatchLevel ?: 'zip-city';
            }
        }

        if (
            !$originMatch &&
            !empty($originCity) &&
            !empty($listingOriginCity) &&
            !$destMatch &&
            !empty($destCity) &&
            !empty($listingDestCity)
        ) {
            $directMatch = strcasecmp($originCity, $listingOriginCity) === 0 &&
                           strcasecmp($destCity, $listingDestCity) === 0;

            $reverseMatch = strcasecmp($originCity, $listingDestCity) === 0 &&
                            strcasecmp($destCity, $listingOriginCity) === 0;

            if ($directMatch || $reverseMatch) {
                $originMatch = true;
                $destMatch = true;
                $dispatchMatchLevel = $dispatchMatchLevel ?: 'city';
            }
        }

        if (
            !$originMatch &&
            !empty($originState) &&
            !empty($listingOriginState) &&
            !$destMatch &&
            !empty($destState) &&
            !empty($listingDestState)
        ) {
            $directMatch = strcasecmp($originState, $listingOriginState) === 0 &&
                           strcasecmp($destState, $listingDestState) === 0;

            $reverseMatch = strcasecmp($originState, $listingDestState) === 0 &&
                            strcasecmp($destState, $listingOriginState) === 0;

            if ($directMatch || $reverseMatch) {
                $originMatch = true;
                $destMatch = true;
                $dispatchMatchLevel = $dispatchMatchLevel ?: 'state';
            }
        }

        if ($originMatch && $destMatch) {
            if (empty($Vehicles)) {
                $row['match_level'] = $dispatchMatchLevel;
                $row['vehicle_match_level'] = 'none_required';
                $matchedListings2[] = $row;
                continue;
            }

            foreach ($Vehicles as $index => $vehicle) {
                $condition = strtolower($vehicle['Inoperable'] === 'Yes' ? '2' : '1');
                $type = strtolower(trim($vehicle['Vehicle_Type'] ?? ''));
                $trailerCondition = strtolower($Trailer_Type === 'Open' ? '1' : '2');
                
                $listingCondition = strtolower(trim(preg_replace('/\*\^+/', '', $row['condition'])));
                $listingTrailer = strtolower(trim(preg_replace('/\*\^+/', '', $row['transport'])));
                $listingType = strtolower(trim(preg_replace('/\*\^+/', '', $row['type'])));
                
                // $listingCondition = strtolower(trim($row['condition']));
                // $listingTrailer = strtolower(trim($row['transport']));
                // $listingType = strtolower(trim($row['type']));
                 
                if ($condition === $listingCondition && 
                    !empty($type) && 
                    !empty($listingType) && 
                    str_contains($listingType, $type) && 
                    $trailerCondition === $listingTrailer) {
                    
                    $vehicleStats2[$index]['total_price'] += $row['price'];
                    $vehicleStats2[$index]['count']++;
                    $vehicleStats2[$index]['matches'][] = $row;
                    $vehicleStats2[$index]['vehicle_match_level'] = 'strict';
                    
                    $totalCombinedPrice2 += $row['price'];
                    $totalCombinedCount2++;
                    
                    $strictMatchesFound2 = true;
                    $row['match_level'] = $dispatchMatchLevel;
                    $row['vehicle_match_level'] = 'strict';
                    $strictMatchedListings2[] = $row;
                }
            }
        }
    }

    $neededMatches2 = max(0, 10 - count($strictMatchedListings2));
    
    if ($neededMatches2 > 0) {
        foreach ($dispatchData as $row) {
            if (count($defaultMatchedListings2) >= $neededMatches2) {
                break;
            }
        
        $listingOriginParts = explode(',', str_replace(' ', '', $row['originzsc']));
        $listingDestParts = explode(',', str_replace(' ', '', $row['destinationzsc']));
        
        $listingOriginCity = trim($listingOriginParts[0] ?? '');
        $listingOriginState = trim($listingOriginParts[1] ?? '');
        $listingOriginZip = trim($listingOriginParts[2] ?? '');
        
        $listingDestCity = trim($listingDestParts[0] ?? '');
        $listingDestState = trim($listingDestParts[1] ?? '');
        $listingDestZip = trim($listingDestParts[2] ?? '');
        
        $originMatch = false;
        $destMatch = false;
    
        if (!empty($originZip) && !empty($listingOriginZip) && !empty($destZip) && !empty($listingDestZip)) {
            if (($originZip === $listingOriginZip && $destZip === $listingDestZip) || ($originZip === $listingDestZip && $destZip === $listingOriginZip)) {
                $originMatch = true;
                $destMatch = true;
                $dispatchMatchLevel = 'zip';
            }
        }

        if (!$originMatch && !$destMatch && !empty($originZip) && !empty($destCity)) {
            if ($originZip === $listingOriginZip && strcasecmp($destCity, $listingDestCity) === 0) {
                $originMatch = true;
                $destMatch = true;
                $dispatchMatchLevel = $dispatchMatchLevel ?: 'zip-city';
            }
        }

        if (
            !$originMatch &&
            !empty($originCity) &&
            !empty($listingOriginCity) &&
            !$destMatch &&
            !empty($destCity) &&
            !empty($listingDestCity)
        ) {
            $directMatch = strcasecmp($originCity, $listingOriginCity) === 0 &&
                           strcasecmp($destCity, $listingDestCity) === 0;

            $reverseMatch = strcasecmp($originCity, $listingDestCity) === 0 &&
                            strcasecmp($destCity, $listingOriginCity) === 0;

            if ($directMatch || $reverseMatch) {
                $originMatch = true;
                $destMatch = true;
                $dispatchMatchLevel = $dispatchMatchLevel ?: 'city';
            }
        }

        if (
            !$originMatch &&
            !empty($originState) &&
            !empty($listingOriginState) &&
            !$destMatch &&
            !empty($destState) &&
            !empty($listingDestState)
        ) {
            $directMatch = strcasecmp($originState, $listingOriginState) === 0 &&
                           strcasecmp($destState, $listingDestState) === 0;

            $reverseMatch = strcasecmp($originState, $listingDestState) === 0 &&
                            strcasecmp($destState, $listingOriginState) === 0;

            if ($directMatch || $reverseMatch) {
                $originMatch = true;
                $destMatch = true;
                $dispatchMatchLevel = $dispatchMatchLevel ?: 'state';
            }
        }

            if ($originMatch && $destMatch) {
                foreach ($Vehicles as $index => $vehicle) {
                    $type = strtolower(trim($vehicle['Vehicle_Type'] ?? ''));
                    
                    // $listingCondition = strtolower(trim($row['condition'] ?? '1'));
                    // $listingTrailer = strtolower(trim($row['transport'] ?? '1'));
                    // $listingType = strtolower(trim($row['type'] ?? 'car'));

                    $listingCondition = strtolower(trim(preg_replace('/\*\^+/', '', $row['condition'] ?? '1')));
                    $listingTrailer = strtolower(trim(preg_replace('/\*\^+/', '', $row['transport'] ?? '1')));
                    $listingType = strtolower(trim(preg_replace('/\*\^+/', '', $row['type'] ?? 'car')));

                    if ($listingCondition === '1' && 
                        (empty($type) || empty($listingType) || 
                         str_contains($listingType, 'car') || 
                         str_contains($listingType, 'suv') || 
                         str_contains($listingType, 'pickup')) && 
                        $listingTrailer === '1') {
                        
                        // Check if this listing was already matched in strict phase
                        $alreadyMatched = false;
                        foreach ($strictMatchedListings2 as $strictMatch) {
                            if ($strictMatch['id'] == $row['id']) { // Assuming each row has unique 'id'
                                $alreadyMatched = true;
                                break;
                            }
                        }
                        
                        if (!$alreadyMatched) {
                            $vehicleStats2[$index]['total_price'] += $row['price'];
                            $vehicleStats2[$index]['count']++;
                            $vehicleStats2[$index]['matches'][] = $row;
                            $vehicleStats2[$index]['vehicle_match_level'] = 'default';
                            
                            $totalCombinedPrice2 += $row['price'];
                            $totalCombinedCount2++;
                            
                            $row['match_level'] = $dispatchMatchLevel;
                            $row['vehicle_match_level'] = 'default';
                            $defaultMatchedListings2[] = $row;
                        }
                    }
                }
            }
        }
    }

    $matchedListings2 = array_merge($strictMatchedListings2, $defaultMatchedListings2);

    foreach ($vehicleStats2 as &$stats) {
        $stats['average_price'] = $stats['count'] > 0 
            ? round($stats['total_price'] / $stats['count'], 2)
            : 0;
    }

    $overallAverage2 = $totalCombinedCount2 > 0 
        ? round($totalCombinedPrice2 / $totalCombinedCount2, 2)
        : 0;




    // Listed Listing

    $matchedListings = [];
    $strictMatchedListings = [];
    $defaultMatchedListings = [];
    $matchLevel = null;
    $vehicleStats = [];
    $totalCombinedPrice = 0;
    $totalCombinedCount = 0;
    $strictMatchesFound = false;

    foreach ($Vehicles as $index => $vehicle) {
        $vehicleStats[$index] = [
            'vehicle' => $vehicle,
            'total_price' => 0,
            'count' => 0,
            'average_price' => 0,
            'matches' => [],
            'vehicle_match_level' => null
        ];
    }

    foreach ($listingData as $row) {
        $listingOriginParts = explode(',', str_replace(' ', '', $row['originzsc']));
        $listingDestParts = explode(',', str_replace(' ', '', $row['destinationzsc']));
        
        $listingOriginCity = trim($listingOriginParts[0] ?? '');
        $listingOriginState = trim($listingOriginParts[1] ?? '');
        $listingOriginZip = trim($listingOriginParts[2] ?? '');
        
        $listingDestCity = trim($listingDestParts[0] ?? '');
        $listingDestState = trim($listingDestParts[1] ?? '');
        $listingDestZip = trim($listingDestParts[2] ?? '');

        $originMatch = false;
        $destMatch = false;
    
        if (!empty($originZip) && !empty($listingOriginZip) && !empty($destZip) && !empty($listingDestZip)) {
            if (($originZip === $listingOriginZip && $destZip === $listingDestZip) || ($originZip === $listingDestZip && $destZip === $listingOriginZip)) {
                $originMatch = true;
                $destMatch = true;
                $matchLevel = 'zip';
            }
        }

        if (!$originMatch && !$destMatch && !empty($originZip) && !empty($destCity)) {
            if ($originZip === $listingOriginZip && strcasecmp($destCity, $listingDestCity) === 0) {
                $originMatch = true;
                $destMatch = true;
                $matchLevel = $matchLevel ?: 'zip-city';
            }
        }

        if (
            !$originMatch &&
            !empty($originCity) &&
            !empty($listingOriginCity) &&
            !$destMatch &&
            !empty($destCity) &&
            !empty($listingDestCity)
        ) {
            $directMatch = strcasecmp($originCity, $listingOriginCity) === 0 &&
                           strcasecmp($destCity, $listingDestCity) === 0;

            $reverseMatch = strcasecmp($originCity, $listingDestCity) === 0 &&
                            strcasecmp($destCity, $listingOriginCity) === 0;

            if ($directMatch || $reverseMatch) {
                $originMatch = true;
                $destMatch = true;
                $matchLevel = $matchLevel ?: 'city';
            }
        }

        if (
            !$originMatch &&
            !empty($originState) &&
            !empty($listingOriginState) &&
            !$destMatch &&
            !empty($destState) &&
            !empty($listingDestState)
        ) {
            $directMatch = strcasecmp($originState, $listingOriginState) === 0 &&
                           strcasecmp($destState, $listingDestState) === 0;

            $reverseMatch = strcasecmp($originState, $listingDestState) === 0 &&
                            strcasecmp($destState, $listingOriginState) === 0;

            if ($directMatch || $reverseMatch) {
                $originMatch = true;
                $destMatch = true;
                $matchLevel = $matchLevel ?: 'state';
            }
        }

        if ($originMatch && $destMatch) {
            if (empty($Vehicles)) {
                $row['match_level'] = $matchLevel;
                $row['vehicle_match_level'] = 'none_required';
                $matchedListings[] = $row;
                continue;
            }

            foreach ($Vehicles as $index => $vehicle) {
                $condition = strtolower($vehicle['Inoperable'] === 'Yes' ? '2' : '1');
                $type = strtolower(trim($vehicle['Vehicle_Type'] ?? ''));
                $trailerCondition = strtolower($Trailer_Type === 'Open' ? '1' : '2');
                
                $listingCondition = strtolower(trim(preg_replace('/\*\^+/', '', $row['condition'])));
                $listingTrailer = strtolower(trim(preg_replace('/\*\^+/', '', $row['transport'])));
                $listingType = strtolower(trim(preg_replace('/\*\^+/', '', $row['type'])));

                // $listingCondition = strtolower(trim($row['condition']));
                // $listingTrailer = strtolower(trim($row['transport']));
                // $listingType = strtolower(trim($row['type']));

                if ($condition === $listingCondition && 
                    !empty($type) && 
                    !empty($listingType) && 
                    str_contains($listingType, $type) && 
                    $trailerCondition === $listingTrailer) {
                    
                    $vehicleStats[$index]['total_price'] += $row['listed_price'];
                    $vehicleStats[$index]['count']++;
                    $vehicleStats[$index]['matches'][] = $row;
                    $vehicleStats[$index]['vehicle_match_level'] = 'strict';
                    
                    $totalCombinedPrice += $row['listed_price'];
                    $totalCombinedCount++;
                    
                    $strictMatchesFound = true;
                    $row['match_level'] = $matchLevel;
                    $row['vehicle_match_level'] = 'strict';
                    $strictMatchedListings[] = $row;
                }
            }
        }
    }

    $neededMatches = max(0, 10 - count($strictMatchedListings));
    
    if ($neededMatches > 0) {
        foreach ($listingData as $row) {
            if (count($defaultMatchedListings) >= $neededMatches) {
                break; // Stop when we have enough
            }
            
        $listingOriginParts = explode(',', str_replace(' ', '', $row['originzsc']));
        $listingDestParts = explode(',', str_replace(' ', '', $row['destinationzsc']));
        
        $listingOriginCity = trim($listingOriginParts[0] ?? '');
        $listingOriginState = trim($listingOriginParts[1] ?? '');
        $listingOriginZip = trim($listingOriginParts[2] ?? '');
        
        $listingDestCity = trim($listingDestParts[0] ?? '');
        $listingDestState = trim($listingDestParts[1] ?? '');
        $listingDestZip = trim($listingDestParts[2] ?? '');

        $originMatch = false;
        $destMatch = false;
    
        if (!empty($originZip) && !empty($listingOriginZip) && !empty($destZip) && !empty($listingDestZip)) {
            if (($originZip === $listingOriginZip && $destZip === $listingDestZip) || ($originZip === $listingDestZip && $destZip === $listingOriginZip)) {
                $originMatch = true;
                $destMatch = true;
                $matchLevel = 'zip';
            }
        }

        if (!$originMatch && !$destMatch && !empty($originZip) && !empty($destCity)) {
            if ($originZip === $listingOriginZip && strcasecmp($destCity, $listingDestCity) === 0) {
                $originMatch = true;
                $destMatch = true;
                $matchLevel = $matchLevel ?: 'zip-city';
            }
        }

        if (
            !$originMatch &&
            !empty($originCity) &&
            !empty($listingOriginCity) &&
            !$destMatch &&
            !empty($destCity) &&
            !empty($listingDestCity)
        ) {
            $directMatch = strcasecmp($originCity, $listingOriginCity) === 0 &&
                           strcasecmp($destCity, $listingDestCity) === 0;

            $reverseMatch = strcasecmp($originCity, $listingDestCity) === 0 &&
                            strcasecmp($destCity, $listingOriginCity) === 0;

            if ($directMatch || $reverseMatch) {
                $originMatch = true;
                $destMatch = true;
                $matchLevel = $matchLevel ?: 'city';
            }
        }

        if (
            !$originMatch &&
            !empty($originState) &&
            !empty($listingOriginState) &&
            !$destMatch &&
            !empty($destState) &&
            !empty($listingDestState)
        ) {
            $directMatch = strcasecmp($originState, $listingOriginState) === 0 &&
                           strcasecmp($destState, $listingDestState) === 0;

            $reverseMatch = strcasecmp($originState, $listingDestState) === 0 &&
                            strcasecmp($destState, $listingOriginState) === 0;

            if ($directMatch || $reverseMatch) {
                $originMatch = true;
                $destMatch = true;
                $matchLevel = $matchLevel ?: 'state';
            }
        }

            if ($originMatch && $destMatch) {
                foreach ($Vehicles as $index => $vehicle) {
                    $type = strtolower(trim($vehicle['Vehicle_Type'] ?? ''));

                    $listingCondition = strtolower(trim(preg_replace('/\*\^+/', '', $row['condition'] ?? '1')));
                    $listingTrailer = strtolower(trim(preg_replace('/\*\^+/', '', $row['transport'] ?? '1')));
                    $listingType = strtolower(trim(preg_replace('/\*\^+/', '', $row['type'] ?? 'car')));
                    
                    // $listingCondition = strtolower(trim($row['condition'] ?? '1'));
                    // $listingTrailer = strtolower(trim($row['transport'] ?? '1'));
                    // $listingType = strtolower(trim($row['type'] ?? 'car'));

                    if ($listingCondition === '1' && 
                        (empty($type) || empty($listingType) || 
                         str_contains($listingType, 'car') || 
                         str_contains($listingType, 'suv') || 
                         str_contains($listingType, 'pickup')) && 
                        $listingTrailer === '1') {
                        
                        // Check if this listing was already matched in strict phase
                        $alreadyMatched = false;
                        foreach ($strictMatchedListings as $strictMatch) {
                            if ($strictMatch['id'] == $row['id']) { // Assuming each row has unique 'id'
                                $alreadyMatched = true;
                                break;
                            }
                        }
                        
                        if (!$alreadyMatched) {
                            $vehicleStats[$index]['total_price'] += $row['listed_price'];
                            $vehicleStats[$index]['count']++;
                            $vehicleStats[$index]['matches'][] = $row;
                            $vehicleStats[$index]['vehicle_match_level'] = 'default';
                            
                            $totalCombinedPrice += $row['listed_price'];
                            $totalCombinedCount++;
                            
                            $row['match_level'] = $matchLevel;
                            $row['vehicle_match_level'] = 'default';
                            $defaultMatchedListings[] = $row;
                        }
                    }
                }
            }
        }
    }

    $matchedListings = array_merge($strictMatchedListings, $defaultMatchedListings);

    foreach ($vehicleStats as &$stats) {
        $stats['average_price'] = $stats['count'] > 0 
            ? round($stats['total_price'] / $stats['count'], 2)
            : 0;
    }

    $overallAverage = $totalCombinedCount > 0 
        ? round($totalCombinedPrice / $totalCombinedCount, 2)
        : 0;

    return response()->json([
        'washington_success' => true,
        'matches' => $matchedListings,
        'miles' => $Miles,
        'count' => count($matchedListings),
        'match_level' => $matchLevel,
        'vehicle_stats' => $vehicleStats,
        'overall_average_price' => $overallAverage,

        'washington_success2' => true,
        'matches2' => $matchedListings2,
        'miles2' => $Miles,
        'count2' => count($matchedListings2),
        'match_level2' => $dispatchMatchLevel,
        'vehicle_stats2' => $vehicleStats2,
        'overall_average_price2' => $overallAverage2
    ]);

}
 else {

        $Origin = str_replace(' ', '', $request->Origin);
        $Destination = str_replace(' ', '', $request->Destination);

        $originParts = explode(',', $Origin);
        $destParts = explode(',', $Destination);

        $originCity = trim($originParts[0] ?? '');
        $originState = trim($originParts[1] ?? '');
        $originZip = trim($originParts[2] ?? '');

        $destCity = trim($destParts[0] ?? '');
        $destState = trim($destParts[1] ?? '');
        $destZip = trim($destParts[2] ?? '');

        $Vehicles = $request->Vehicles;
        $TrailerType = $request->TrailerType;
        $Miles = $request->Miles;
    
        $response = Http::get('https://price.shipa1.com/api/price-data');
        $priceData = $response->json();
    
        $matchedPrice = null;
    
        foreach ($priceData as $row) {
            if ($Miles >= $row['minimum_range'] && $Miles <= $row['maximum_range']) {
                $matchedPrice = $row['price'] * $Miles;
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

        $response_zce = Http::get('https://price.shipa1.com/api/zip-code-exceptions-data');
        $zipcodeData = $response_zce->json();

        $response_se = Http::get('https://price.shipa1.com/api/state-exceptions-data');
        $stateData = $response_se->json();
    
        $vehicleDetails = [];
        $totalVehicleAdjustment = 0;

        $zipmatched = false;
        $statematched = false;

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

        if (!empty($originZip) && !empty($destZip)) {
            foreach ($zipcodeData as $data) {
                if (isset($data['destination_zipcode']) && isset($data['origin_zipcode']) && (trim($data['origin_zipcode']) === $originZip && trim($data['destination_zipcode']) === $destZip)) {
                    if (isset($data['value']) && isset($data['operation_type'])) {
                        if (strtolower($data['operation_type']) === 'add') {
                            $matchedPrice += $data['value'];
                            $zipmatched = true;
                        } elseif (strtolower($data['operation_type']) === 'sub') {
                            $matchedPrice -= $data['value'];
                            $zipmatched = true;
                        }
                    }
                }
            }
        }

        if (!$zipmatched && !empty($originZip)) {
            foreach ($zipcodeData as $data) {
                if (isset($data['origin_zipcode']) && trim($data['origin_zipcode']) == $originZip) {
                    if (isset($data['value']) && isset($data['operation_type'])) {
                        if (strtolower($data['operation_type']) === 'add') {
                            $matchedPrice += $data['value'];
                            $zipmatched = true;
                        } elseif (strtolower($data['operation_type']) === 'sub') {
                            $matchedPrice -= $data['value'];
                            $zipmatched = true;
                        }
                    }
                }
            }
        }

        if (!$zipmatched && !empty($destZip)) {
            foreach ($zipcodeData as $data) {
                if (isset($data['destination_zipcode']) && trim($data['destination_zipcode']) == $destZip) {
                    if (isset($data['value']) && isset($data['operation_type'])) {
                        if (strtolower($data['operation_type']) === 'add') {
                            $matchedPrice += $data['value'];
                            $zipmatched = true;
                        } elseif (strtolower($data['operation_type']) === 'sub') {
                            $matchedPrice -= $data['value'];
                            $zipmatched = true;
                        }
                    }
                }
            }
        }

        if (!empty($originState) && !empty($destState)) {
            foreach ($stateData as $data) {
                if (isset($data['destination_state']) && isset($data['origin_state']) && ($data['origin_state'] == $originState && $data['destination_state'] == $destState)) {
                    if (isset($data['value']) && isset($data['operation_type'])) {
                        if (strtolower($data['operation_type']) === 'add') {
                            $matchedPrice += $data['value'];
                            $statematched = true;
                        } elseif (strtolower($data['operation_type']) === 'sub') {
                            $matchedPrice -= $data['value'];
                            $statematched = true;
                        }
                    }
                }
            }
        }

        if (!$statematched && !empty($originState)) {
            foreach ($stateData as $data) {
                if (isset($data['origin_state']) && $data['origin_state'] == $originState) {
                    if (isset($data['value']) && isset($data['operation_type'])) {
                        if (strtolower($data['operation_type']) === 'add') {
                            $matchedPrice += $data['value'];
                            $statematched = true;
                        } elseif (strtolower($data['operation_type']) === 'sub') {
                            $matchedPrice -= $data['value'];
                            $statematched = true;
                        }
                    }
                }
            }
        }

        if (!$statematched && !empty($destState)) {
            foreach ($stateData as $data) {
                if (isset($data['destination_state']) && $data['destination_state'] == $destState) {
                    if (isset($data['value']) && isset($data['operation_type'])) {
                        if (strtolower($data['operation_type']) === 'add') {
                            $matchedPrice += $data['value'];
                            $statematched = true;
                        } elseif (strtolower($data['operation_type']) === 'sub') {
                            $matchedPrice -= $data['value'];
                            $statematched = true;
                        }
                    }
                }
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
