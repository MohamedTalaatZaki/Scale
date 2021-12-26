<?php


namespace App\Filters\SampledPivot;


use App\Filters\AbstractBasicFilter;

class ToDateFilter extends AbstractBasicFilter
{
    public function filter($value)
    {
        if($value != "") {
            $this->builder->where('test_date', '<=', $value);
        }
    }
}
