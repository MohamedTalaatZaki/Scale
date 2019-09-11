<?php
/**
 * Created by PhpStorm.
 * User: Sanatechnology
 * Date: 2019-09-11
 * Time: 9:28 AM
 */

namespace App\Filters;


use App\Filters\User\CodeFilter;
use App\Filters\User\EmailFilter;
use App\Filters\User\FullNameFilter;
use App\Filters\User\IsActiveFilter;
use App\Filters\User\RoleFilter;
use App\Filters\User\UserNameFilter;

class UsersIndexFilter extends AbstractFilter
{
    protected $filters = [
        'user_name'=>UserNameFilter::class,
        'full_name'=>FullNameFilter::class,
        'email'=>EmailFilter::class,
        'employee_code'=>CodeFilter::class,
        'is_active'=>IsActiveFilter::class,
        'role'=>RoleFilter::class
    ];

}