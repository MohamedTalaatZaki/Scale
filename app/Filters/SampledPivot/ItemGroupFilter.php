<?php


namespace App\Filters\SampledPivot;


use App\Filters\AbstractBasicFilter;

class ItemGroupFilter extends AbstractBasicFilter
{
    public function filter($value)
    {
        return $this->builder->where('item_group_id' , $value);
    }
}

