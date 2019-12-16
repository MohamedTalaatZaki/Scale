<?php


namespace App\Filters\Dashboard;


use App\Filters\AbstractBasicFilter;

class ItemTypeFilter extends AbstractBasicFilter
{
    public function filter($value)
    {
        $this->builder->where('item_type_prefix' , $value);
    }
}
