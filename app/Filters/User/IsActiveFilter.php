<?php
/**
 * Created by PhpStorm.
 * User: Sanatechnology
 * Date: 2019-09-11
 * Time: 10:50 AM
 */

namespace App\Filters\User;


use App\Filters\AbstractBasicFilter;

class IsActiveFilter extends AbstractBasicFilter
{
    public function filter($value)
    {
        return $this->builder->whereIn('is_active',$value);
    }

}