<?php


namespace App\Filters\SampledTest;


use App\Filters\AbstractBasicFilter;

class QcTestNameFilter extends AbstractBasicFilter
{
    public function filter($value)
    {
        if($value > 0) {
            $this->builder->whereHas('qcTestHeader', function ($q) use ($value) {
                $q->where('id', $value);
            });
        }
    }
}
