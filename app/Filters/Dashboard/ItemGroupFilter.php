<?php


namespace App\Filters\Dashboard;


use App\Filters\AbstractBasicFilter;

class ItemGroupFilter extends AbstractBasicFilter
{
    public function filter($value)
    {
        $this->builder->where('item_group_id' , $value);
    }
}
