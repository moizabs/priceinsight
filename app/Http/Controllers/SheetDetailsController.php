<?php

namespace App\Http\Controllers;

use App\Models\SheetDetails;
use App\Models\Washington;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SheetDetailsController extends Controller
{
    // public function getUnpricedRecord()
    // {
    //     $record = SheetDetails::whereNull('price')
    //         ->orWhere('price', 0)
    //         ->orderBy('created_at', 'asc')
    //         ->first();

    //     return response()->json([
    //         'record' => $record,
    //         'exists' => $record !== null
    //     ]);
    // }

    // public function saveRecordPrice(Request $request)
    // {
    //     $request->validate([
    //         'record_id' => 'required|exists:sheet_details,id',
    //         'price' => 'required|numeric|min:0',
    //         'listed_price' => 'required|numeric|min:0'
    //     ]);

    //     $record = SheetDetails::find($request->record_id);
    //     $record->price = $request->price;
    //     $record->listed_price = $request->listed_price;
    //     $record->user_id = Auth::guard('authorized')->user()->id;
    //     $record->save();

    //     $lrecord = new Washington();
    //     $lrecord->originzsc = $record->originzsc;
    //     $lrecord->destinationzsc = $record->destinationzsc;
    //     $lrecord->ymk = $record->ymk;
    //     $lrecord->condition = $record->condition;
    //     $lrecord->type = $record->type;
    //     $lrecord->transport = $record->transport;
    //     $lrecord->listed_price = $request->listed_price;
    //     $lrecord->pstatus = 9;
    //     $lrecord->user_id = Auth::guard('authorized')->user()->id;
    //     $lrecord->save();

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Price saved successfully'
    //     ]);
    // }




    public function getUnpricedRecord()
{

    $record = SheetDetails::where(function($query) {
            $query->whereNull('price')
                  ->orWhere('price', 0);
        })
        ->whereNull('locked_by')
        ->orderBy('created_at', 'asc')
        ->first();

    return response()->json([
        'record' => $record,
        'exists' => $record !== null
    ]);
}

public function lockRecord(Request $request)
{
    $request->validate([
        'record_id' => 'required|exists:sheet_details,id'
    ]);

    $record = SheetDetails::find($request->record_id);
    
    if ($record->locked_by && $record->locked_by != Auth::guard('authorized')->user()->id) {
        return response()->json([
            'success' => false,
            'message' => 'Record already locked by another user'
        ]);
    }
    
    $record->locked_by = Auth::guard('authorized')->user()->id;
    $record->locked_at = now();
    $record->save();

    return response()->json([
        'success' => true,
        'message' => 'Record locked successfully'
    ]);
}

public function checkRecordAvailability($recordId)
{
    $record = SheetDetails::find($recordId);
    
    return response()->json([
        'available' => !$record->locked_by || $record->locked_by == Auth::guard('authorized')->user()->id
    ]);
}

public function checkRecordStatus($recordId)
{
    $record = SheetDetails::find($recordId);
    
    return response()->json([
        'is_available' => !$record->locked_by || $record->locked_by == Auth::guard('authorized')->user()->id,
        'is_priced' => !empty($record->price)
    ]);
}


public function saveRecordPrice(Request $request)
{
    $request->validate([
        'record_id' => 'required|exists:sheet_details,id',
        'price' => 'required|numeric|min:0',
        'listed_price' => 'required|numeric|min:0'
    ]);

    $record = SheetDetails::find($request->record_id);
    
    if ($record->locked_by != Auth::guard('authorized')->user()->id) {
        return response()->json([
            'success' => false,
            'message' => 'You no longer have the lock on this record'
        ]);
    }

    $record->price = $request->price;
    $record->listed_price = $request->listed_price;
    $record->user_id = Auth::guard('authorized')->user()->id;
    $record->locked_by = null;
    $record->save();


    $record2 = new SheetDetails();
    $record2->price = $request->pdispatch_price2;
    $record2->pstatus = 10;
    $record2->listed_price = $request->plisted_price2;
    $record2->originzsc = $request->porigin2;
    $record2->destinationzsc = $request->pdestination2;
    $record2->ymk = $record->ymk;
    $record2->condition = $request->pinoperable2;
    $record2->type = $request->pvehicle_type2;
    $record2->transport = $request->ptrailer_type2;
    $record2->user_id = Auth::guard('authorized')->user()->id;
    $record2->locked_by = null;
    $record2->save();

  







    

    $lrecord = new Washington();
    $lrecord->originzsc = $record->originzsc;
    $lrecord->destinationzsc = $record->destinationzsc;
    $lrecord->ymk = $record->ymk;
    $lrecord->condition = $record->condition;
    $lrecord->type = $record->type;
    $lrecord->transport = $record->transport;
    $lrecord->listed_price = $request->listed_price;
    $lrecord->pstatus = 9;
    $lrecord->user_id = Auth::guard('authorized')->user()->id;
    $lrecord->save();

    return response()->json([
        'success' => true,
        'message' => 'Price saved successfully'
    ]);
}
}