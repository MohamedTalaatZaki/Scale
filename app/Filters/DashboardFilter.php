<?php


namespace App\Filters;


use App\Filters\Dashboard\FromDateFilter;
use App\Filters\Dashboard\ItemGroupFilter;
use App\Filters\Dashboard\SupplierFilter;
use App\Filters\Dashboard\ToDateFilter;
use App\Filters\Dashboard\ItemTypeFilter;

class DashboardFilter extends AbstractFilter
{
    protected $filters  =   [
        'filter_item_type'  =>  ItemTypeFilter::class,
        'filter_from_date'  =>  FromDateFilter::class,
        'filter_to_date'    =>  ToDateFilter::class,
        'filter_item_group' =>  ItemGroupFilter::class,
        'filter_supplier'   =>  SupplierFilter::class
    ];
}
