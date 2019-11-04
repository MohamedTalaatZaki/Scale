<?php
/**
 * Created by PhpStorm.
 * User: Sanatechnology
 * Date: 2019-09-11
 * Time: 9:28 AM
 */

namespace App\Filters;


use App\Filters\SampledTest\CreatedByFilter;
use App\Filters\SampledTest\FromDateFilter;
use App\Filters\SampledTest\QcTestNameFilter;
use App\Filters\SampledTest\SupplierFilter;
use App\Filters\SampledTest\ToDateFilter;
use App\Filters\SampledTest\TruckPlateFilter;


class SampledTestFilter extends AbstractFilter
{
    protected $filters = [
        'truck_plates'=>TruckPlateFilter::class,
        'qc_test_id'=>QcTestNameFilter::class,
        'supplier_id'=>SupplierFilter::class,
        'user_id'=>CreatedByFilter::class,
        'from_date'=>FromDateFilter::class,
        'to_date'=>ToDateFilter::class
    ];

}
