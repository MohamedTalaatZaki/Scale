<?php

namespace App\Http\Controllers\QC;

use App\Models\Security\TransportDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SamplesTestController extends Controller
{
    public function create()
    {
        $transport_detail   =   TransportDetail::query()->findOrFail(\request()->get('transport_detail_id'))->load('transport' , 'testableType.qcTestHeader.details');

        return view('quality-control.sample-test.create' , ['transport_detail'  =>  $transport_detail]);
    }
}
