<?php


namespace App\Filters\TruckSummaryReport;


use App\Filters\AbstractBasicFilter;

class ItemGroupIdFilter extends AbstractBasicFilter
{
    public function filter($value)
    {
        return $this->builder->where('item_group_id' , $value);
    }
}

