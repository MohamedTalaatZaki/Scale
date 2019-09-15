<?php


namespace App\Filters\Item;


use App\Filters\AbstractBasicFilter;

class EnNameFilter extends AbstractBasicFilter
{
    public function filter($value)
    {
        $this->builder->where('en_name' , 'like' , "%$value%");
    }
}
