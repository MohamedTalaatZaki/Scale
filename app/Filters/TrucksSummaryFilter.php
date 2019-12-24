<?php


namespace App\Filters;


use App\Filters\SampledTest\TruckPlateFilter;
use App\Filters\TruckSummary\InWeightDateFilter;
use App\Filters\TruckSummary\ItemIdFilter;
use App\Filters\TruckSummary\SupplierIdFilter;
use App\Filters\TruckSummary\TransportIdFilter;

class TrucksSummaryFilter extends AbstractFilter
{
    protected $filters = [
        'transport_number'  =>  TransportIdFilter::class,
        'supplier_id'   =>  SupplierIdFilter::class,
        'date'  =>  InWeightDateFilter::class,
        'truck_plates'  =>  TruckPlateFilter::class,
        'item_id'   =>  ItemIdFilter::class
    ];
}
