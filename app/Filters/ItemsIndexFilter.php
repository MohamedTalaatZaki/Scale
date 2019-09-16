<?php


namespace App\Filters;


use App\Filters\Item\ArNameFilter;
use App\Filters\Item\EnNameFilter;
use App\Filters\Item\SapCodeFilter;

class ItemsIndexFilter extends AbstractFilter
{
    protected $filters  =   [
        'ar_name'   =>  ArNameFilter::class,
        'en_name'   =>  EnNameFilter::class,
        'sap_code'  =>  SapCodeFilter::class
    ];
}
