<?php

namespace App\Http\Controllers\Production;

use App\Models\Production\Line;
use App\Models\Production\TransportLine;
use App\Models\Security\TransportDetail;
use App\Models\Supplier\Supplier;
use App\Traits\AuthorizeTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductionProcessController extends Controller
{
    use AuthorizeTrait;
    public function index()
    {
        $this->authorized('production-process.index');
        $not_started_transport_details  =    TransportDetail::query()->RawNotStartedTransports()->get();
        $started_transport_details      =    TransportDetail::query()->RawStartedTransports()->get();
        $lines  =   Line::query()->where('is_active' , true)->where('type' , 'ProdLine')->get();
        return view('production.production-process.index' , [
            'not_started_transport_details' => $not_started_transport_details,
            'started_transport_details'     => $started_transport_details,
            'lines' =>  $lines
        ]);
    }

    public function startProcess(Request $request)
    {
        $this->authorized('startProcess');
        $this->validate($request , [
            'item_group_id' =>  'required',
            'item_id' =>  'required',
            'day' =>  'required|size:2',
            'month' =>  'required|size:2',
            'year' =>  'required|size:3',
            'batch_num' =>  'required',
            'line_id' =>  'required',
        ]);

        $transportDetail    =   TransportDetail::query()->find($request->input('detail_id'));

        $transportDetail->transport()->update([
            'item_group_id' =>  $request->input('item_group_id'),
        ]);

        $transportDetail->update([
            'item_group_id' =>  $request->input('item_group_id'),
            'item_id'       =>  $request->input('item_id'),
            'status'        =>  'start_unload',
        ]);

        $transportDetail->LastTransportLine()->first()->update([
            'batch_number'  => $request->input('batch_number'),
            'started_at'    =>  Carbon::now(),
            'line_id'       =>  $request->input('line_id'),
        ]);

        return redirect()->back()->with('success' , trans('global.transport_start_successful'));
    }

    public function finishProcess(Request $request)
    {
        $this->authorized('finishProcess');
        $detail =    TransportDetail::query()->RawStartedTransports()->find($request->input('detail_id'));
        if($detail)
        {
            $detail->update(['status' => 'processed' , 'discount' => $request->input('discount')]);
            $detail->LastTransportLine()->first()->update([
                'finished_at'   =>  Carbon::now(),
                'line_is_delay' =>  $request->input('line_is_delay'),
                'finish_comment'    =>  $request->input('finish_comment'),
            ]);
            return response('done' , 200);
        }
        return response('error' , 400);
    }

    public function transferLine(Request $request)
    {
        $this->authorized('transferLine');
        $detail =    TransportDetail::query()->RawStartedTransports()->find($request->input('detail_id'));
        if($detail)
        {
            $detail->update(['status' => 're_weight']);
            $detail->LastTransportLine()->first()->update([
                'finished_at'   =>  Carbon::now(),
            ]);
        }
        return redirect()->back()->with('success' , trans('global.truck_reweight'));
    }

    public function getLastBatch()
    {
        $batchNumber    =   optional(TransportLine::query()->whereNotNull('batch_number')->orderByDesc('batch_number')->first())->batch_number;
        return  $batchNumber ? substr($batchNumber , 7) : "";
    }

    public function getSupplierItemByGroup(Request $request)
    {
        $supplier  =   Supplier::query()->find($request->input('supplierId'));

        if($supplier)
        {
            $items  =   $supplier->items()
                ->where('item_group_id' , $request->input('itemGroupId'))
                ->whereHas('type' , function ($q){
                    $q->where('prefix' , 'raw');
                })
                ->get();
            return response()->json(['items' => $items->pluck('name' , 'id')]);
        }

        return response()->json(['items' => []]);
    }
}
