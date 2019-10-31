<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\QC\QcTestDetail;
use Faker\Generator as Faker;

$factory->define(QcTestDetail::class, function (Faker $faker) {
    return [
      'id' => 1000,
      'ar_name' =>$faker->name,
      'en_name' =>$faker->name,
      'test_type' =>$faker->name,
      'element_type' =>$faker->name,
    ];
});

$factory->defineAs(QcTestDetail::class, 'fake_test_details1',function (Faker $faker) {
    return [
      'qc_element_id' => 1,
      'qc_test_header_id' => 1000,
      'expected_result' => 0,
      'min_range' => 20,
      'max_range' => 30,
    ];
});

$factory->defineAs(QcTestDetail::class, 'fake_test_details2',function (Faker $faker) {
    return [
      'qc_element_id' => 7,
      'qc_test_header_id' => 1000,
      'expected_result' => 1,
    ];
});
