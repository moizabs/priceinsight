<?php

namespace App\Http\Controllers;

use App\Models\SheetDetails;
use App\Models\Washington;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

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
            'id',
            'originzsc',
            'destinationzsc', 
            'ymk',
            'listed_price',
            'condition',
            'type',
            'transport',
            'user_id',
            'created_at',
            'pstatus'
        ])
        ->whereNotNull('listed_price')
        ->where('listed_price', '!=', '')
        ->orderBy('created_at', 'desc')
        ->with('authorized_user')
        ->get();

        if ($records->isEmpty()) {
            return response()->json([
                'success' => true,
                'data' => [],
                'message' => 'No records found'
            ]);
        }

        $data = $records->map(function ($item) {
            return [
                'id' => $item->id,
                'origin_location' => $item->originzsc ?? 'N/A',
                'destination_location' => $item->destinationzsc ?? 'N/A',
                'vehicle_info' => $item->ymk ?? 'N/A',
                'price' => $item->listed_price ?? '0.00',
                'type' => $item->type ?? 'Unknown',
                'user' => $item->authorized_user->name ?? 'Washington',
                'transportE' => $item->transport,
                'conditionE' => $item->condition,
                'condition' => match($item->condition) {
                    '1' => 'Operable',
                    '2' => 'Inoperable',
                    default => 'Unknown'
                },
                'transport' => match($item->transport) {
                    '1' => 'Open',
                    '2' => 'Enclosed',
                    default => 'Unknown'
                },
                'status' => match($item->pstatus) {
                    0 => 'New',
                    1 => 'Interested',
                    2 => 'FollowMore',
                    3 => 'AskingLow',
                    4 => 'NotInterested',
                    5 => 'NoResponse',
                    6 => 'TimeQuote',
                    7 => 'PaymentMissing',
                    8 => 'Booked',
                    9 => 'Listed',
                    10 => 'Scheduled',
                    11 => 'Pickup',
                    12 => 'Delivered',
                    13 => 'Completed',
                    14 => 'Cancelled',
                    18 => 'OnApproval',
                    19 => 'CancelOnApproval',
                    15 => 'Deleted',
                    16 => 'OwesMoney',
                    17 => 'CarrierUpdate',
                    default => 'Unknown'
                },
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


    public function dispatchListing()
    {
       return view('washington-dispatch-listing');
    }


    public function getAllDispatchListing()
{
    try {
        $records = SheetDetails::select([
            'id',
            'originzsc',
            'destinationzsc', 
            'ymk',
            'listed_price',
            'price',
            'condition',
            'type',
            'transport',
            'user_id',
            'created_at',
            'pstatus'
        ])
        ->whereNotNull('price')
        ->where('price', '!=', '')
        ->orderBy('created_at', 'desc')
        ->with('authorized_user')
        ->get();

        if ($records->isEmpty()) {
            return response()->json([
                'success' => true,
                'data' => [],
                'message' => 'No records found'
            ]);
        }

        $data = $records->map(function ($item) {
            return [
                'id' => $item->id,
                'origin_location' => $item->originzsc ?? 'N/A',
                'destination_location' => $item->destinationzsc ?? 'N/A',
                'vehicle_info' => $item->ymk ?? 'N/A',
                'dispatch_price' => $item->price ?? '0.00',
                'type' => $item->type ?? 'Unknown',
                'user' => $item->authorized_user->name ?? 'Washington',
                'transportE' => $item->transport,
                'conditionE' => $item->condition,
                'condition' => match($item->condition) {
                    '1' => 'Operable',
                    '2' => 'Inoperable',
                    default => 'Unknown'
                },
                'transport' => match($item->transport) {
                    '1' => 'Open',
                    '2' => 'Enclosed',
                    default => 'Unknown'
                },
                'status' => match($item->pstatus) {
                    0 => 'New',
                    1 => 'Interested',
                    2 => 'FollowMore',
                    3 => 'AskingLow',
                    4 => 'NotInterested',
                    5 => 'NoResponse',
                    6 => 'TimeQuote',
                    7 => 'PaymentMissing',
                    8 => 'Booked',
                    9 => 'Listed',
                    10 => 'Scheduled',
                    11 => 'Pickup',
                    12 => 'Delivered',
                    13 => 'Completed',
                    14 => 'Cancelled',
                    18 => 'OnApproval',
                    19 => 'CancelOnApproval',
                    15 => 'Deleted',
                    16 => 'OwesMoney',
                    17 => 'CarrierUpdate',
                    default => 'Unknown'
                },
                'entery_date' => optional($item->created_at)->toDateTimeString() ?? 'N/A',
            ];            
        });

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
        
    } catch (\Exception $e) {
        Log::error('Dispatch Listing Error: ' . $e->getMessage());
        Log::error($e->getTraceAsString());
        return response()->json([
            'success' => false, 
            'message' => 'Server error: ' . $e->getMessage()
        ], 500);
    } 
}





// Listed Listing Price
    public function listedListingPriceAdd(Request $request)
    {
        $request->validate([
            'origin_location' => 'required',
            'destination_location' => 'required',
            'vehicle_year' => 'required',
            'vehicle_make' => 'required',
            'vehicle_model' => 'required',
            'vehicle_type' => 'required',
            'vehicle_condition' => 'required',
            'trailer_type' => 'required',
            'dispatch_price' => 'required',
        ]);
    
        $dp = new Washington();
        $dp->originzsc = $request->origin_location;
        $dp->destinationzsc = $request->destination_location;
        $dp->ymk = $request->vehicle_year . ' ' . $request->vehicle_make . ' ' . $request->vehicle_model;
        $dp->condition = $request->vehicle_condition;
        $dp->type = $request->vehicle_type;
        $dp->transport = $request->trailer_type;
        $dp->pstatus = 9;
        $dp->listed_price = $request->dispatch_price;
        $dp->user_id = Auth::guard('authorized')->user()->id;
        $dp->save();
    
        return response()->json([
            'success' => true,
        ]);
    }



    public function listedListingPriceEdit(Request $request, $id)
    {
        $request->validate([
            'origin_location' => 'required',
            'destination_location' => 'required',
            'vehicle_type' => 'required',
            'vehicle_condition' => 'required',
            'trailer_type' => 'required',
            'dispatch_price' => 'required',
        ]);
    
        $dp = Washington::findOrFail($id);
        $dp->originzsc = $request->origin_location;
        $dp->destinationzsc = $request->destination_location;
        $dp->condition = $request->vehicle_condition;
        $dp->type = $request->vehicle_type;
        $dp->transport = $request->trailer_type;
        $dp->listed_price = $request->dispatch_price;
        $dp->user_id = Auth::guard('authorized')->user()->id;
        $dp->save();
    
        return response()->json(['success' => true]);
    }
    

    public function listedListingPriceDelete($id)
    {
        $DID = $id;
        Washington::destroy($DID);

        return response()->json(['success' => true]);
    }




    public function listeduploadCSV(Request $request)
{
    $validator = Validator::make($request->all(), [
        'csv_file' => 'required|file|mimes:csv,txt|max:2048'
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => 'Invalid file. Please upload a valid CSV file.'
        ], 400);
    }

    $file = $request->file('csv_file');
    $filePath = $file->getRealPath();
    
    try {
        $data = array_map('str_getcsv', file($filePath));
        $header = array_shift($data);
        
        // Validate headers
        $requiredHeaders = [
            'origin_location', 'destination_location', 'vehicle_year', 
            'vehicle_make', 'vehicle_model', 'vehicle_type', 
            'vehicle_condition', 'trailer_type', 'listed_price'
        ];
        
        foreach ($requiredHeaders as $requiredHeader) {
            if (!in_array($requiredHeader, $header)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid CSV format. Missing required column: ' . $requiredHeader
                ], 400);
            }
        }
        
        $successCount = 0;
        $errorCount = 0;
        $errors = [];
        
        DB::beginTransaction();
        
        foreach ($data as $row) {
            $row = array_combine($header, $row);
            
            try {
                // Validate and process each row
                $validator = Validator::make($row, [
                    'origin_location' => 'required|string',
                    'destination_location' => 'required|string',
                    'vehicle_year' => 'required|numeric|min:1900|max:2025',
                    'vehicle_make' => 'required|string',
                    'vehicle_model' => 'required|string',
                    'vehicle_type' => 'required|string',
                    'vehicle_condition' => 'required|in:1,2',
                    'trailer_type' => 'required|in:1,2',
                    'listed_price' => 'required|numeric|min:0'
                ]);
                
                if ($validator->fails()) {
                    $errorCount++;
                    $errors[] = 'Row ' . ($successCount + $errorCount) . ': ' . implode(', ', $validator->errors()->all());
                    continue;
                }
          
                // Create new listed listing record
                Washington::create([
                    'originzsc' => $row['origin_location'],
                    'destinationzsc' => $row['destination_location'],
                    'ymk' => $row['vehicle_year'] . ' ' . $row['vehicle_make'] . ' ' . $row['vehicle_model'],
                    'type' => $row['vehicle_type'],
                    'condition' => $row['vehicle_condition'],
                    'transport' => $row['trailer_type'],
                    'pstatus' => 9,
                    'listed_price' => $row['listed_price'],
                    'user_id' => Auth::guard('authorized')->user()->id
                ]);
                
                $successCount++;
                
            } catch (\Exception $e) {
                $errorCount++;
                $errors[] = 'Row ' . ($successCount + $errorCount) . ': ' . $e->getMessage();
            }
        }
        
        DB::commit();
        
        $message = "Successfully imported {$successCount} records.";
        if ($errorCount > 0) {
            $message .= " {$errorCount} records failed. Errors: " . implode('; ', $errors);
        }
        
        return response()->json([
            'success' => true,
            'message' => $message
        ]);
        
    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json([
            'success' => false,
            'message' => 'Error processing CSV: ' . $e->getMessage()
        ], 500);
    }
}







// Dispatch Listing Price
public function dispatchListingPriceAdd(Request $request)
    {
        $request->validate([
            'origin_location' => 'required',
            'destination_location' => 'required',
            'vehicle_year' => 'required',
            'vehicle_make' => 'required',
            'vehicle_model' => 'required',
            'vehicle_type' => 'required',
            'vehicle_condition' => 'required',
            'trailer_type' => 'required',
            'dispatch_price' => 'required',
        ]);
    
        $dp = new SheetDetails();
        $dp->originzsc = $request->origin_location;
        $dp->destinationzsc = $request->destination_location;
        $dp->ymk = $request->vehicle_year . ' ' . $request->vehicle_make . ' ' . $request->vehicle_model;
        $dp->condition = $request->vehicle_condition;
        $dp->type = $request->vehicle_type;
        $dp->transport = $request->trailer_type;
        $dp->pstatus = 10;
        $dp->price = $request->dispatch_price;
        $dp->user_id = Auth::guard('authorized')->user()->id;
        $dp->save();
    
        return response()->json([
            'success' => true,
        ]);
    }



    public function dispatchListingPriceEdit(Request $request, $id)
    {
        $request->validate([
            'origin_location' => 'required',
            'destination_location' => 'required',
            'vehicle_type' => 'required',
            'vehicle_condition' => 'required',
            'trailer_type' => 'required',
            'dispatch_price' => 'required',
        ]);
    
        $dp = SheetDetails::findOrFail($id);
        $dp->originzsc = $request->origin_location;
        $dp->destinationzsc = $request->destination_location;
        $dp->condition = $request->vehicle_condition;
        $dp->type = $request->vehicle_type;
        $dp->transport = $request->trailer_type;
        $dp->price = $request->dispatch_price;
        $dp->user_id = Auth::guard('authorized')->user()->id;
        $dp->save();
    
        return response()->json(['success' => true]);
    }
    

    public function dispatchListingPriceDelete($id)
    {
        $DID = $id;
        SheetDetails::destroy($DID);

        return response()->json(['success' => true]);
    }




    public function uploadCSV(Request $request)
{
    $validator = Validator::make($request->all(), [
        'csv_file' => 'required|file|mimes:csv,txt|max:2048'
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => 'Invalid file. Please upload a valid CSV file.'
        ], 400);
    }

    $file = $request->file('csv_file');
    $filePath = $file->getRealPath();
    
    try {
        $data = array_map('str_getcsv', file($filePath));
        $header = array_shift($data);
        
        // Validate headers
        $requiredHeaders = [
            'origin_location', 'destination_location', 'vehicle_year', 
            'vehicle_make', 'vehicle_model', 'vehicle_type', 
            'vehicle_condition', 'trailer_type', 'dispatch_price'
        ];
        
        foreach ($requiredHeaders as $requiredHeader) {
            if (!in_array($requiredHeader, $header)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid CSV format. Missing required column: ' . $requiredHeader
                ], 400);
            }
        }
        
        $successCount = 0;
        $errorCount = 0;
        $errors = [];
        
        DB::beginTransaction();
        
        foreach ($data as $row) {
            $row = array_combine($header, $row);
            
            try {
                // Validate and process each row
                $validator = Validator::make($row, [
                    'origin_location' => 'required|string',
                    'destination_location' => 'required|string',
                    'vehicle_year' => 'required|numeric|min:1900|max:2025',
                    'vehicle_make' => 'required|string',
                    'vehicle_model' => 'required|string',
                    'vehicle_type' => 'required|string',
                    'vehicle_condition' => 'required|in:1,2',
                    'trailer_type' => 'required|in:1,2',
                    'dispatch_price' => 'required|numeric|min:0'
                ]);
                
                if ($validator->fails()) {
                    $errorCount++;
                    $errors[] = 'Row ' . ($successCount + $errorCount) . ': ' . implode(', ', $validator->errors()->all());
                    continue;
                }
          
                // Create new dispatch listing record
                SheetDetails::create([
                    'originzsc' => $row['origin_location'],
                    'destinationzsc' => $row['destination_location'],
                    'ymk' => $row['vehicle_year'] . ' ' . $row['vehicle_make'] . ' ' . $row['vehicle_model'],
                    'type' => $row['vehicle_type'],
                    'condition' => $row['vehicle_condition'],
                    'transport' => $row['trailer_type'],
                    'pstatus' => 10,
                    'price' => $row['dispatch_price'],
                    'user_id' => Auth::guard('authorized')->user()->id
                ]);
                
                $successCount++;
                
            } catch (\Exception $e) {
                $errorCount++;
                $errors[] = 'Row ' . ($successCount + $errorCount) . ': ' . $e->getMessage();
            }
        }
        
        DB::commit();
        
        $message = "Successfully imported {$successCount} records.";
        if ($errorCount > 0) {
            $message .= " {$errorCount} records failed. Errors: " . implode('; ', $errors);
        }
        
        return response()->json([
            'success' => true,
            'message' => $message
        ]);
        
    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json([
            'success' => false,
            'message' => 'Error processing CSV: ' . $e->getMessage()
        ], 500);
    }
}




// Dispatch
//  10 => 'Scheduled',
//                     11 => 'Pickup',
//                     12 => 'Delivered',
//                     13 => 'Completed',
//                     18 => 'OnApproval',


// Listed
// 9 => 'Listed',
//                     10 => 'Scheduled',
//                     11 => 'Pickup',
//                     12 => 'Delivered',
//                     13 => 'Completed',
//                     14 => 'Cancelled',
//                     18 => 'OnApproval',
//                     19 => 'CancelOnApproval',

}