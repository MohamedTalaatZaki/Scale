<?php


namespace App\Filters\SampledTest;


use App\Filters\AbstractBasicFilter;

class SupplierFilter extends AbstractBasicFilter
{
    public function filter($value)
    {
        if($value > 0) {
            $this->builder->whereHas('transportDetail.transport.supplier', function ($q) use ($value) {
                $q->where('id', $value);
            });
        }
    }
}
