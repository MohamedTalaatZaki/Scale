<?php

namespace App\Http\Controllers\QC;

use App\Models\Security\TruckArrival;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArrivedTrucksController extends Controller
{
    public function index()
    {
        return view('quality-control.arrived-trucks.index');
    }


    public function toggleTruckStatus(Request $request)
    {
        $truck  =   TruckArrival::query()
            ->where(function($q) {
                $q->where('status' , 'arrived')
                ->orWhere('status' , 'sampled');
            })
            ->whereHas('testableType')
            ->find($request->input('id'));

        if($truck) {
            $truck->update([
                'status'    =>  $request->input('status'),
            ]);
        }

        return response()->json(['result' => $request->input('status')]);
    }
}
