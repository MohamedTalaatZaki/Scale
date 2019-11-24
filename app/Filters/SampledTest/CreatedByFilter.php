<?php


namespace App\Filters\SampledTest;


use App\Filters\AbstractBasicFilter;

class CreatedByFilter extends AbstractBasicFilter
{
    public function filter($value)
    {
        if($value > 0) {
            $this->builder->where('created_by' , $value);
        }

    }
}
