<?php
/**
 * Created by PhpStorm.
 * User: Sanatechnology
 * Date: 2019-09-11
 * Time: 10:50 AM
 */

namespace App\Filters\User;


use App\Filters\AbstractBasicFilter;

class CodeFilter extends AbstractBasicFilter
{
    public function filter($value)
    {
        return $this->builder->where('employee_code','like',"%{$value}%");
    }

}
