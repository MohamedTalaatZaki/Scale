<?php

namespace App\Http\Controllers\Scale;

use App\Models\Security\TransportDetail;
use App\Models\Security\Transports;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TrucksScaleController extends Controller
{
    public function index()
    {
        app()->setLocale('ar');
        return view('scale.trucks-scale.index');
    }

    public function checkBarcode(Request $request) {
        $transportDetail    =   TransportDetail::query()
            ->whereHas('transport' , function ($q) use($request){$q->where('transport_number' , $request->input('transport_id'));})
            ->find($request->input('detail_id'))
            ->load('transport');

        return response()->json(['transport'    =>  $transportDetail]);
    }
}
