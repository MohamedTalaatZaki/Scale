<?php


namespace App\Filters\SampledTest;


use App\Filters\AbstractBasicFilter;

class TruckPlateFilter extends AbstractBasicFilter
{
    public function filter($value)
    {
        if($value != "") {
            $this->builder->where('truck_plates', 'like', "%$value%");
        }
    }
}
