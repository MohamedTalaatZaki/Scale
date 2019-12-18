<?php


namespace App\Filters\Dashboard;


use App\Filters\AbstractBasicFilter;

class ToDateFilter extends AbstractBasicFilter
{
    public function filter($value)
    {
        if($value != "") {
            $this->builder->whereDate('created_at', '<=', $value);
        }
    }
}
