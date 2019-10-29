<?php


namespace App\Filters\Item;


use App\Filters\AbstractBasicFilter;

class SupplierFilter extends AbstractBasicFilter
{
    public function filter($value)
    {
        $this->builder->whereHas('suppliers' , function ($q) use($value){
            $q->where('id' , $value);
        });
    }
}
