<?php
/**
 * Created by PhpStorm.
 * User: Sanatechnology
 * Date: 2019-09-11
 * Time: 9:28 AM
 */

namespace App\Filters;


use App\Filters\SampledPivot\ResultFilter;
use App\Filters\SampledPivot\FromDateFilter;
use App\Filters\SampledPivot\ItemGroupFilter;
use App\Filters\SampledPivot\ToDateFilter;


class SampledPivotFilter extends AbstractFilter
{
    protected $filters = [
        'item_group_id'=>ItemGroupFilter::class,
        'from_date'=>FromDateFilter::class,
        'to_date'=>ToDateFilter::class,
        'result'=>ResultFilter::class
    ];

}
