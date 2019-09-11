<?php
/**
 * Created by PhpStorm.
 * User: Sanatechnology
 * Date: 2019-09-11
 * Time: 10:52 AM
 */

namespace App\Filters\User;


use App\Filters\AbstractBasicFilter;

class FullNameFilter extends AbstractBasicFilter
{
    public function filter($value)
    {
        return $this->builder->where('full_name','like',"%{$value}%");
    }

}