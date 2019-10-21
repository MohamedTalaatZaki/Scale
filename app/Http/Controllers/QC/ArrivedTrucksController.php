<?php

namespace App\Http\Controllers\QC;

use App\Models\Security\TruckArrival;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArrivedTrucksController extends Controller
{
    public function index()
    {
        $arrived    =   TruckArrival::query()
            ->where('status' , 'arrived')
            ->whereHas('testableType')
            ->get();

        $sampled    =   TruckArrival::query()
            ->where('status' , 'sampled')
            ->orWhere('status' , 'retest')
            ->whereHas('testableType')
            ->get();

        $accepted   =   TruckArrival::query()
            ->where('status' , 'accepted')
            ->whereHas('testableType')
            ->get();

        $rejected   =   TruckArrival::query()
            ->where('status' , 'rejected')
            ->whereHas('testableType')
            ->get();

        return view('quality-control.arrived-trucks.index' , [
            'arrived'   =>  $arrived,
            'sampled'   =>  $sampled,
            'accepted'  =>  $accepted,
            'rejected'  =>  $rejected
        ]);
    }


    public function toggleTruckStatus(Request $request)
    {
        $truck  =   TruckArrival::query()
            ->where(function($q) {
                $q->where('status' , 'arrived')
                    ->orWhere('status' , 'retest')
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
