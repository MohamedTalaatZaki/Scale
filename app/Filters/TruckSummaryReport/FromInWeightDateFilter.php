<?php


namespace App\Filters\TruckSummaryReport;


use App\Filters\AbstractBasicFilter;

class FromInWeightDateFilter extends AbstractBasicFilter
{
    public function filter($value)
    {
        return $this->builder->whereDate('in_weight_time' , '>=' , $value);
    }
}

