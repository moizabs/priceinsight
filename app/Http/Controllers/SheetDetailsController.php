<?php

namespace App\Http\Controllers;

use App\Models\SheetDetails;
use App\Models\Washington;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

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
        'listed_price' => 'required|numeric|min:0',

        'pdispatch_price2' => 'required|numeric|min:0',
        'plisted_price2' => 'required|numeric|min:0',

        'pdispatch_price3' => 'required|numeric|min:0',
        'plisted_price3' => 'required|numeric|min:0',

        'pdispatch_price4' => 'required|numeric|min:0',
        'plisted_price4' => 'required|numeric|min:0',

        'pdispatch_price5' => 'required|numeric|min:0',
        'plisted_price5' => 'required|numeric|min:0',

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
    $record2->pstatus = 10;
    $record2->price = $request->pdispatch_price2;    
    $record2->listed_price = $request->plisted_price2;
    $record2->originzsc = $request->porigin2;
    $record2->destinationzsc = $request->pdestination2;
    $record2->ymk = $record->ymk;
    $record2->condition = $request->pinoperable2;
    $record2->type = $request->pvehicle_type2;
    $record2->transport = $request->ptrailer_type2;
    $record2->user_id = Auth::guard('authorized')->user()->id;
    $record2->locked_by = null;
    $record2->locked_at = now();
    $record2->save();


    $record3 = new SheetDetails();
    $record3->pstatus = 10;
    $record3->price = $request->pdispatch_price3;    
    $record3->listed_price = $request->plisted_price3;
    $record3->originzsc = $request->porigin3;
    $record3->destinationzsc = $request->pdestination3;
    $record3->ymk = $record->ymk;
    $record3->condition = $request->pinoperable3;
    $record3->type = $request->pvehicle_type3;
    $record3->transport = $request->ptrailer_type3;
    $record3->user_id = Auth::guard('authorized')->user()->id;
    $record3->locked_by = null;
    $record3->locked_at = now();
    $record3->save();


    $record4 = new SheetDetails();
    $record4->pstatus = 10;
    $record4->price = $request->pdispatch_price4;    
    $record4->listed_price = $request->plisted_price4;
    $record4->originzsc = $request->porigin4;
    $record4->destinationzsc = $request->pdestination4;
    $record4->ymk = $record->ymk;
    $record4->condition = $request->pinoperable4;
    $record4->type = $request->pvehicle_type4;
    $record4->transport = $request->ptrailer_type4;
    $record4->user_id = Auth::guard('authorized')->user()->id;
    $record4->locked_by = null;
    $record4->locked_at = now();
    $record4->save();


    $record5 = new SheetDetails();
    $record5->pstatus = 10;
    $record5->price = $request->pdispatch_price5;    
    $record5->listed_price = $request->plisted_price5;
    $record5->originzsc = $request->porigin5;
    $record5->destinationzsc = $request->pdestination5;
    $record5->ymk = $record->ymk;
    $record5->condition = $request->pinoperable5;
    $record5->type = $request->pvehicle_type5;
    $record5->transport = $request->ptrailer_type5;
    $record5->user_id = Auth::guard('authorized')->user()->id;
    $record5->locked_by = null;
    $record5->locked_at = now();
    $record5->save();
  

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


    $lrecord2 = new Washington();
    $lrecord2->originzsc = $request->porigin2;
    $lrecord2->destinationzsc = $request->pdestination2;
    $lrecord2->ymk = $record->ymk;
    $lrecord2->condition = $request->pinoperable2;
    $lrecord2->type = $request->pvehicle_type2;
    $lrecord2->transport = $request->ptrailer_type2;
    $lrecord2->listed_price = $request->plisted_price2;
    $lrecord2->pstatus = 9;
    $lrecord2->user_id = Auth::guard('authorized')->user()->id;
    $lrecord2->save();


    $lrecord3 = new Washington();
    $lrecord3->originzsc = $request->porigin3;
    $lrecord3->destinationzsc = $request->pdestination3;
    $lrecord3->ymk = $record->ymk;
    $lrecord3->condition = $request->pinoperable3;
    $lrecord3->type = $request->pvehicle_type3;
    $lrecord3->transport = $request->ptrailer_type3;
    $lrecord3->listed_price = $request->plisted_price3;
    $lrecord3->pstatus = 9;
    $lrecord3->user_id = Auth::guard('authorized')->user()->id;
    $lrecord3->save();


    $lrecord4 = new Washington();
    $lrecord4->originzsc = $request->porigin4;
    $lrecord4->destinationzsc = $request->pdestination4;
    $lrecord4->ymk = $record->ymk;
    $lrecord4->condition = $request->pinoperable4;
    $lrecord4->type = $request->pvehicle_type4;
    $lrecord4->transport = $request->ptrailer_type4;
    $lrecord4->listed_price = $request->plisted_price4;
    $lrecord4->pstatus = 9;
    $lrecord4->user_id = Auth::guard('authorized')->user()->id;
    $lrecord4->save();


    $lrecord5 = new Washington();
    $lrecord5->originzsc = $request->porigin5;
    $lrecord5->destinationzsc = $request->pdestination5;
    $lrecord5->ymk = $record->ymk;
    $lrecord5->condition = $request->pinoperable5;
    $lrecord5->type = $request->pvehicle_type5;
    $lrecord5->transport = $request->ptrailer_type5;
    $lrecord5->listed_price = $request->plisted_price5;
    $lrecord5->pstatus = 9;
    $lrecord5->user_id = Auth::guard('authorized')->user()->id;
    $lrecord5->save();

    return response()->json([
        'success' => true,
        'message' => 'Price saved successfully'
    ]);
}
}