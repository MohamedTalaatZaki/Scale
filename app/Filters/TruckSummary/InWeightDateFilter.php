<?php


namespace App\Filters\TruckSummary;


use App\Filters\AbstractBasicFilter;

class InWeightDateFilter extends AbstractBasicFilter
{
    public function filter($value)
    {
        return $this->builder->whereDate('in_weight_time' , $value);
    }
}

