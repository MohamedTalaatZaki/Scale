<?php


namespace App\Filters\TruckSummary;


use App\Filters\AbstractBasicFilter;

class ItemIdFilter extends AbstractBasicFilter
{
    public function filter($value)
    {
        return $this->builder->where('item_id' , $value);
    }
}

