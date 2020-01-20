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

class ScrapProcessController extends Controller
{
    use AuthorizeTrait;
    public function index()
    {
        $this->authorized('scrap-process.index');
        $not_started_transport_details  =    TransportDetail::query()->ScrapNotStartedTransports()->get();
        $started_transport_details      =    TransportDetail::query()->ScrapStartedTransports()->get();
        $lines  =   Line::query()->where('is_active' , true)->where('type' , 'ScrapLine')->get();
        $suppliers  =   Supplier::query()->get();
        return view('production.scrap-process.index' , [
            'not_started_transport_details' => $not_started_transport_details,
            'started_transport_details'     => $started_transport_details,
            'lines' =>  $lines,
            'suppliers'    =>  $suppliers
        ]);
    }

    public function startProcess(Request $request)
    {
        $this->authorized('scrapStartProcess');
        $this->validate($request , [
            'supplier_id'   =>  'required',
            'item_group_id' =>  'required',
            'item_id' =>  'required',
            'line_id' =>  'required',
        ]);

        $transportDetail    =   TransportDetail::query()->find($request->input('detail_id'));

        $transportDetail->transport()->update([
            'item_group_id' =>  $request->input('item_group_id'),
            'supplier_id'   =>  $request->input('supplier_id')
        ]);

        $transportDetail->update([
            'item_group_id' =>  $request->input('item_group_id'),
            'item_id'       =>  $request->input('item_id'),
            'status'        =>  'start_load',
        ]);

        $transportDetail->LastTransportLine()->first()->update([
            'batch_number'  =>  '',
            'started_at'    =>  Carbon::now(),
            'line_id'       =>  $request->input('line_id'),
        ]);

        return redirect()->back()->with('success' , trans('global.transport_start_successful'));
    }

    public function finishProcess(Request $request)
    {
        $this->authorized('scrapFinishProcess');
        $detail =    TransportDetail::query()->ScrapStartedTransports()->find($request->input('detail_id'));
        if($detail)
        {
            $detail->update(['status' => 'processed']);
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
        $this->authorized('scrapTransferLine');
        $detail =    TransportDetail::query()->ScrapStartedTransports()->find($request->input('detail_id'));
        if($detail)
        {
            $detail->update(['status' => 're_weight']);
            $detail->LastTransportLine()->first()->update([
                'finished_at'   =>  Carbon::now(),
            ]);
        }
        return redirect()->back()->with('success' , trans('global.truck_reweight'));
    }

    public function getSupplierItemByGroup(Request $request)
    {
        $supplier  =   Supplier::query()->find($request->input('supplierId'));

        if($supplier)
        {
            $items  =   $supplier->items()
                ->where('item_group_id' , $request->input('itemGroupId'))
                ->whereHas('type' , function ($q){
                    $q->where('prefix' , 'scrap');
                })
                ->get();
            return response()->json(['items' => $items->pluck('name' , 'id')]);
        }

        return response()->json(['items' => []]);
    }
}
