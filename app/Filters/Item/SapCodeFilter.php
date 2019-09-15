<?php


namespace App\Filters\Item;


use App\Filters\AbstractBasicFilter;

class SapCodeFilter extends AbstractBasicFilter
{
    public function filter($value)
    {
        $this->builder->where('sap_code' , 'like' , "%$value%");
    }
}
