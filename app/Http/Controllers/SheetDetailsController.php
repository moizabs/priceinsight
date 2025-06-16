<?php

namespace App\Http\Controllers;

use App\Models\SheetDetails;
use Illuminate\Http\Request;

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
            'price' => 'required|numeric|min:0'
        ]);

        $record = SheetDetails::find($request->record_id);
        $record->price = $request->price;
        $record->save();

        return response()->json([
            'success' => true,
            'message' => 'Price saved successfully'
        ]);
}
}
