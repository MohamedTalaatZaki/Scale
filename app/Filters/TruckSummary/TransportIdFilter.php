<?php


namespace App\Filters\TruckSummary;


use App\Filters\AbstractBasicFilter;

class TransportIdFilter extends AbstractBasicFilter
{
    public function filter($value)
    {
        return $this->builder->where('transport_number' , $value);
    }
}
