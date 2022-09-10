<?php

namespace App\Http\Controllers\Production;

use App\Filters\TrucksSummaryReportFilter;
use App\Models\Items\Item;
use App\Models\Items\ItemGroup;
use App\Models\Supplier\Supplier;
use App\Models\views\TruckSummary;
use App\Traits\AuthorizeTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class TruckSummaryReportController extends Controller
{
    use AuthorizeTrait;

    public function index(Request $request)
    {
        $this->authorized('truck-summary-report.index');
        if(sizeof($request->input()) > 0)
        {
            $trucks =   TruckSummary::query()->groupBy(
                'transport_id' ,
                'transport_number' ,
                'supplier_name' ,
                'full_truck_plates',
                'item_name',
                'in_weight'
            )->select('transport_id' ,
                'transport_number' ,
                'supplier_name' ,
                'full_truck_plates',
                'item_name',
                DB::raw('SUM(discount) as discount , SUM(in_weight) as in_weight , SUM(out_weight) as out_weight , SUM(Net_weight_af_disc) as Net_weight_af_disc'))
                ->filter(new TrucksSummaryReportFilter($request));

            $total = $trucks->get();
            $link = '';

            foreach ($request->input() as $key => $value) {
                 $link = $link.'&'.$key.'='.$value;
            }
            
            return view('production.truck-summary-report.index' , [
                'total'  =>  $total,
                'trucks' => $trucks->get(),
                'suppliers' =>  Supplier::query()->get(),
                'items' =>  ItemGroup::query()->get(),
                'print' =>  (sizeof($request->input()) > 0) ? 1 : 0,
                'link'  =>  $link
            ]);            
        }

        return view('production.truck-summary-report.index' , [
            'total'  =>  new TruckSummary(),
            'trucks' => [],
            'suppliers' =>  Supplier::query()->get(),
            'items' =>  ItemGroup::query()->get(),
            'print' =>  (sizeof($request->input()) > 0) ? 1 : 0,
            'link'  =>  ''
        ]);            

    }
}
