<?php

namespace App\Http\Controllers\Scale;

use App\Models\Production\TransportLine;
use App\Models\Security\TransportDetail;
use App\Models\Security\Transports;
use App\Traits\AuthorizeTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TrucksScaleController extends Controller
{
    use AuthorizeTrait;

    public function index()
    {
        $this->setPageLocale();
        return view('scale.trucks-scale.index');
    }

    public function checkBarcode(Request $request) {
        $this->setPageLocale();
        $transportDetail    =   TransportDetail::query()
            ->TransportCanWeight()
            ->with('transport')
            ->find($request->input('detail_id'));

        $errorMsg           =   optional(TransportDetail::query()->find($request->input('detail_id')))->TransportCannotWeight();
        $cannotWeightMsg    =   $errorMsg ? $errorMsg : trans('global.unknown_transport');

        return response()->json(['transport'    =>  $transportDetail , 'cannot_weight_msg'    =>  $cannotWeightMsg ]);
    }

    public function saveTruckScaleWeight(Request $request)
    {
        $this->setPageLocale();
        $transportDetail    =   TransportDetail::query()
            ->TransportCanWeight()
            ->where('transport_id' , $request->input('transport_id'))
            ->find($request->input('transport_detail_id'));

        if($transportDetail) {
            $response   =   null;
            switch ($transportDetail->status) {
                case "accepted":
                case "waiting":
                    $response   =   $this->inWeight($transportDetail , $request);
                    break;
                case "processed":
                    $response   =   $this->outWeight($transportDetail , $request);
                    break;
                case "re_weight":
                    $response   =   $this->reWeight($transportDetail , $request);
                    break;
                default:
                    return response()->json(['transport'    =>  '' , 'cannot_weight_msg' =>  trans('global.contact_with_support')]);
                    break;
            }
            return response()->json($response);
        } else {

            $cannotWeightMsg    =   !$transportDetail ? TransportDetail::query()->find($request->input('detail_id'))->TransportCannotWeight() : null;
            return response()->json(['transport'    =>  '' , 'cannot_weight_msg' =>  $cannotWeightMsg]);

        }
    }

    private function inWeight($transportDetail , Request $request)
    {
        $transportDetail->update([
            'in_weight' => $request->input('weight'),
            'status' => 'in_process'
        ]);

        $nextTruck  =   TransportDetail::query()
            ->where('transport_id' , $request->input('transport_id'))
            ->TransportCanWeight()
            ->first();

        $this->createTransportLineTransaction($transportDetail->id);

        $transportDetail->transport()->update([
            'total_weight' => $transportDetail->transport->total_weight + $request->input('weight'),
            'status'    =>  (boolean) $nextTruck ? $transportDetail->transport->status : 'in_process',
        ]);

        return [
            'transport' => $transportDetail ,
            'cannot_weight_msg' => null ,
            'swal_msg' => $nextTruck ?
                trans('global.move_next_truck' , ['plate' => $nextTruck->truck_plates , 'name' => $nextTruck->ar_plate_name]) :
                trans('global.save_weight_done'),
        ];
    }

    private function outWeight($transportDetail , Request $request)
    {
        $transportDetail->update([
            'out_weight' => $request->input('weight'),
            'status' => 'out_weight'
        ]);

        $transportDetail->LastTransportLine()->first()->update([
            'weight'    =>  $request->input('weight'),
        ]);

        $nextTruck  =   TransportDetail::query()
            ->where('transport_id' , $request->input('transport_id'))
            ->TransportHasInProcess()
            ->first();

        $transportDetail->transport()->update([
            'weight_difference' => $transportDetail->transport->weight_difference + abs($transportDetail->in_weight - $request->input('weight')),
            'status'    =>  (boolean) $nextTruck ? $transportDetail->transport->status : 'out_weight',
        ]);

        return [
            'transport' => $transportDetail ,
            'cannot_weight_msg' => null ,
            'swal_msg' => $nextTruck ?
                trans('global.move_next_truck' , ['plate' => $nextTruck->truck_plates , 'name' => $nextTruck->ar_plate_name]) :
                trans('global.second_weight_done_out'),
        ];
    }

    private function reWeight($transportDetail , Request $request)
    {
        $transportDetail->update([
            'status'    =>  'in_process',
        ]);

        $transportDetail->LastTransportLine()->first()->update([
            'weight'    =>  $request->input('weight'),
        ]);

        $this->createTransportLineTransaction($transportDetail->id);

        $nextTruck  =   TransportDetail::query()
            ->where('transport_id' , $request->input('transport_id'))
            ->TransportCanReWeight()
            ->first();

        $transportDetail->transport()->update([
            'status'    =>  (boolean) $nextTruck ? $transportDetail->transport->status : 'in_process',
        ]);

        return [
            'transport' => $transportDetail ,
            'cannot_weight_msg' => null ,
            'swal_msg' => $nextTruck ?
                trans('global.move_next_truck' , ['plate' => $nextTruck->truck_plates , 'name' => $nextTruck->ar_plate_name]) :
                trans('global.save_weight_done'),
        ];
    }

    private function setPageLocale()
    {
        app()->setLocale('ar');
    }

    private function createTransportLineTransaction($id)
    {
        TransportLine::query()->create([
            'transport_detail_id'   =>  $id
        ]);
    }
}