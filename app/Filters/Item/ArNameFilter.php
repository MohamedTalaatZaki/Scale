<?php


namespace App\Filters\Item;


use App\Filters\AbstractBasicFilter;

class ArNameFilter extends AbstractBasicFilter
{
    public function filter($value)
    {
        return $this->builder->where('ar_name','like',"%{$value}%");
    }
}
