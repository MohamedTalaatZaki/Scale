<?php


namespace App\Filters\Dashboard;


use App\Filters\AbstractBasicFilter;

class SupplierFilter extends AbstractBasicFilter
{
    public function filter($value)
    {
        $this->builder->where('supplier_id' , $value);
    }
}
