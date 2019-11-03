<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->defineAs(App\Models\QC\SampleTestDetail::class, 'fake_stest_details1',function (Faker $faker) {
    return [
      'sample_test_header_id' => 1000,
      'qc_test_detail_id' => 1000,
      'element_name' => 'Brix',
      'test_type' => 'chemical',
      'element_type' => 'range',
      'min_range' => 20,
      'max_range' => 30,
      'element_unit' => '%',
      'sampled_range' => 60,
      'result' => 'rejected',
      'created_at' => \Carbon\Carbon::now(),
    ];
});

$factory->defineAs(App\Models\QC\SampleTestDetail::class, 'fake_stest_details2',function (Faker $faker) {
  return [
    'sample_test_header_id' => 1000,
    'qc_test_detail_id' => 1000,
    'element_name' => 'Not Damaged',
    'test_type' => 'visual',
    'element_type' => 'question',
    'expected_result' => 1,
    'sampled_expected_result' => 0,
    'result' => 'rejected',
    'created_at' => \Carbon\Carbon::now(),
  ];
});
