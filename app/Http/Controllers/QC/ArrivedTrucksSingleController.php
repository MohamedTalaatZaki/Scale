<?php

namespace App\Http\Controllers\QC;

use App\Models\Security\TransportDetail;
use App\Models\Security\Transports;
use App\Traits\AuthorizeTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class ArrivedTrucksSingleController extends Controller
{
    use AuthorizeTrait;
    public function index()
    {
        $this->authorized('arrived-trucks-single.index');
        $arrived    =   Transports::query()
            ->whereHas('testableType')
            ->whereHas('arrivedDetails')
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

        return view('quality-control.arrived-trucks-single.index' , [
            'arrived'   =>  $arrived,
            'sampled'   =>  $sampled,
            'accepted'  =>  $accepted,
            'rejected'  =>  $rejected
        ]);
    }

    public function show($id)
    {

    }

    public function update($id,Request $request)
    {
        $detail  =   TransportDetail::query()
            ->where(function($q) {
                $q->where('status' , 'arrived')
                    ->orWhere('status' , 'retest')
                    ->orWhere('status' , 'sampled');
            })
            ->whereHas('testableType')
            ->find($id);

        if($detail) {
            $detail->update([
                'status'    =>  $request->input('status'),
            ]);
            $detail->transport->update(['status' =>  $request->input('status')]);
        }

        return redirect()->back();
    }
}
