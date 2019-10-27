<?php

namespace App\Http\Controllers\QC;

use App\Models\Security\TransportDetail;
use App\Models\Security\Transports;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArrivedTrucksController extends Controller
{
    public function index()
    {
        $arrived    =   Transports::query()
            ->whereHas('testableType')
            ->whereHas('arrivedDetails' )
            ->get();

        $sampled    =   Transports::query()
            ->whereHas('testableType')
            ->whereHas('sampledDetails' )
            ->get();

        $accepted   =   Transports::query()
            ->whereHas('testableType')
            ->whereHas('acceptedDetails' )
            ->get();

        $rejected   =   Transports::query()
            ->whereHas('testableType')
            ->whereHas('rejectedDetails' )
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
        $truck  =   TransportDetail::query()
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
