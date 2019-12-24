<?php


namespace App\Filters\TruckSummary;


use App\Filters\AbstractBasicFilter;

class SupplierIdFilter extends AbstractBasicFilter
{
    public function filter($value)
    {
        return $this->builder->where('supplier_id' , $value);
    }
}
