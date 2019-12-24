<?php


namespace App\Filters\TruckSummary;


use App\Filters\AbstractBasicFilter;

class TruckPlatesFilter extends AbstractBasicFilter
{
    public function filter($value)
    {
        return $this->builder->where('truck_plates' , 'LIKE' , "%{$value}%");
    }
}

