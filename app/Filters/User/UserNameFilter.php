<?php
/**
 * Created by PhpStorm.
 * User: Sanatechnology
 * Date: 2019-09-11
 * Time: 10:50 AM
 */

namespace App\Filters\User;


use App\Filters\AbstractBasicFilter;

class UserNameFilter extends AbstractBasicFilter
{
    public function filter($value)
    {
        return $this->builder->where('user_name','like',"%{$value}%");
    }

}