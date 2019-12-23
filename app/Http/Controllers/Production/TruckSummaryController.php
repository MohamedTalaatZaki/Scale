<?php

namespace App\Http\Controllers\Production;

use App\Filters\TrucksSummaryFilter;
use App\Models\Items\Item;
use App\Models\Supplier\Supplier;
use App\Models\views\TruckSummary;
use App\Traits\AuthorizeTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class TruckSummaryController extends Controller
{
    use AuthorizeTrait;

    public function index(Request $request)
    {
        $this->authorized('truck-summary.index');
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
            ->filter(new TrucksSummaryFilter($request))
            ->paginate(25);
        return view('production.truck-summary.index' , [
            'trucks' => $trucks,
            'suppliers' =>  Supplier::query()->get(),
            'items' =>  Item::query()->get(),
        ]);
    }
}
