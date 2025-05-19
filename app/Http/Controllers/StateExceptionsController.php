<?php

namespace App\Http\Controllers;

use App\Models\StateExceptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class StateExceptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('state_exceptions');
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
            'Origin_State' => 'required',
            'Destination_State' => 'nullable',
            'Route_Type' => 'nullable',
            'Operation_Type' => 'required',
            'Value' => 'nullable|numeric',
            'Value_Percentage' => 'nullable|numeric',
        ]);
    
        $se = new StateExceptions();
        $se->origin_state = $request->Origin_State;
        $se->destination_state = $request->Destination_State;
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


    public function getAll(Request $request)
    {
        $records = StateExceptions::with('authorized_users')->latest()->get();

        $data = $records->map(function ($item) {
            return [
                'origin_destination' => ($item->origin_state && $item->destination_state)
                    ? $item->origin_state . ' -> ' . $item->destination_state
                    : ($item->origin_state ?? $item->destination_state ?? ''),
                    
                'route_type' => $item->route_type,
                'entered_by' => $item->authorized_users->name ?? 'Unknown',
                'operation_type' => $item->operation_type,
                'value' => $item->value,
                'value_percentage' => $item->value_percentage,
                'origin_state' => $item->origin_state,
                'destination_state' => $item->destination_state,
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
    public function show(StateExceptions $stateExceptions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StateExceptions $stateExceptions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'route_type' => 'required',
            'value' => 'nullable',
            'operation_type' => 'required',
            'origin_zipcode' => 'nullable',
            'dest_zipcode' => 'nullable',
            'zipcode' => 'nullable',
            'percentage' => 'nullable',
        ]);

        try{
        
            $se = StateExceptions::findOrFail($id);

            if($request->route_type == 'Route'){
                $se->origin_state = $request->origin_zipcode;
                $se->destination_state = $request->dest_zipcode;
            }else if($request->route_type == 'Origin'){
                $se->origin_state = $request->zipcode;
                $se->destination_state = null;
            }else if($request->route_type == 'Destination'){
                $se->origin_state = null;
                $se->destination_state = $request->zipcode;
            }else{
                $se->destination_state = null;
                $se->origin_state = $request->zipcode;
            }

            $se->route_type = $request->route_type;
            $se->operation_type = $request->operation_type;
            $se->value = $request->value;
            $se->value_percentage = $request->percentage;
            $se->save();

        }catch(\Exception $e){
            Log::error("Error" . $e->getMessage());
            return response()->json(['success' => true, 'message' => $e->getMessage()]);
        }
    
        
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        StateExceptions::destroy($id);

        return response()->json(['success' => true]);
    }
}
