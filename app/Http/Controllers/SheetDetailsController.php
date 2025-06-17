<?php

namespace App\Http\Controllers;

use App\Models\SheetDetails;
use App\Models\Washington;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SheetDetailsController extends Controller
{
    public function getUnpricedRecord()
    {
        $record = SheetDetails::whereNull('price')
            ->orWhere('price', 0)
            ->orderBy('created_at', 'asc')
            ->first();

        return response()->json([
            'record' => $record,
            'exists' => $record !== null
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
        $record->price = $request->price;
        $record->listed_price = $request->listed_price;
        $record->user_id = Auth::guard('authorized')->user()->id;
        $record->save();
 
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
