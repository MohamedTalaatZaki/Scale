<?php


namespace App\Filters;


use App\Filters\TruckSummaryReport\FromInWeightDateFilter;
use App\Filters\TruckSummaryReport\ToInWeightDateFilter;
use App\Filters\TruckSummaryReport\ItemGroupIdFilter;
use App\Filters\TruckSummaryReport\SupplierIdFilter;

class TrucksSummaryReportFilter extends AbstractFilter
{
    protected $filters = [
        'supplier_id'   =>  SupplierIdFilter::class,
        'from_date'     =>  FromInWeightDateFilter::class,
        'to_date'       =>  ToInWeightDateFilter::class,
        'item_group_id'       =>  ItemGroupIdFilter::class
    ];
}
