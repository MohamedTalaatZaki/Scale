<?php


namespace App\Filters\SampledPivot;


use App\Filters\AbstractBasicFilter;

class ResultFilter extends AbstractBasicFilter
{
    public function filter($value)
    {
        if($value > 0) {
            $this->builder->where('result' , '=' , $value);
        }
    }
}
