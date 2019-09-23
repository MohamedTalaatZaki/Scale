<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
$factory->defineAs(App\Models\Scales\Scale::class, 'fake_scales',function (Faker $faker) {
    return [
      'code' => $faker->regexify('[A-Za-z]{5}'),
      'ip_address' => $faker->regexify('[A-Za-z]{5}'),
      'limit' => '321',
      'scale_error' => '321',
      'brand' => 'brand',
      'model' => 'model',
      'com_port' => 'com_port',
      'baud_rate' => 150,
      'byte_size' => 'SEVENBITS',
      'stop_bits' => 'STOPBITS_TWO',
      'parity' => 'PARITY_NONE',
      'timeout' => 100,
      'tolerance' => 100,
      'is_active' => 1,
    ];
});
