<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->defineAs(App\Models\QC\QcTestHeader::class, 'fake_qc_tests',function (Faker $faker) {
    return [
      'en_name' => $faker->name,
      'ar_name' => $faker->name,
      'item_group_id' => 10001,
      'is_active' => 1
    ];
});

$factory->defineAs(App\Models\QC\QcTestHeader::class, 'demo_faker',function (Faker $faker) {
    return [
      'id' => 1000,
      'en_name' => $faker->name,
      'ar_name' => $faker->name,
      'item_group_id' => 10001,
      'is_active' => 1
    ];
});
$factory->defineAs(App\Models\QC\QcTestDetail::class, 'demo_faker',function (Faker $faker) {
    return [
      'qc_test_header_id' => 1000,
      'en_name' => $faker->name,
      'ar_name' => $faker->name,
      'test_type' => 'chemical',
      'element_type' => 'range',
      'min_range' => 100,
      'max_range' => 200,
      'element_unit' => 'al'
    ];
});
$factory->defineAs(App\Models\QC\QcTestDetail::class, 'demo_fake1',function (Faker $faker) {
    return [
      'qc_test_header_id' => 1000,
      'en_name' => $faker->name,
      'ar_name' => $faker->name,
      'test_type' => 'visual',
      'element_type' => 'question',
      'expected_result' => 0,
    ];
});
