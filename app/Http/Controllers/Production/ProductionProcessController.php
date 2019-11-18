<?php

namespace App\Http\Controllers\Production;

use App\Models\Security\TransportDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductionProcessController extends Controller
{
    public function index()
    {
        $not_started_transport_details  =    TransportDetail::query()->NotStartedTransports()->get();
        $started_transport_details      =    TransportDetail::query()->StartedTransports()->get();
        return view('production.production-process.index' , [
            'not_started_transport_details' => $not_started_transport_details,
            'started_transport_details'     => $started_transport_details,
        ]);
    }
}
