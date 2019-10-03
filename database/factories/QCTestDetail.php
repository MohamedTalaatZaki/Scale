<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\QC\QcTestDetail;
use Faker\Generator as Faker;

$factory->define(QcTestDetail::class, function (Faker $faker) {
    return [
      'ar_name' =>$faker->name,
      'en_name' =>$faker->name,
      'test_type' =>$faker->name,
      'element_type' =>$faker->name,
    ];
});
