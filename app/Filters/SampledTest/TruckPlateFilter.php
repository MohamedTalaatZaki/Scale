<?php


namespace App\Filters\SampledTest;


use App\Filters\AbstractBasicFilter;

class TruckPlateFilter extends AbstractBasicFilter
{
    public function filter($value)
    {
        if($value != "") {
            $this->builder->whereHas('transportDetail', function ($q) use ($value) {
                $q->where('truck_plates', 'like', "%$value%");
            });
        }
    }
}
