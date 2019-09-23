<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->defineAs(App\Models\Scales\Scale::class, 'demo_faker',function (Faker $faker) {
    return [
      'code' => 666,
      'ip_address' => '123',
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
$factory->defineAs(App\Models\Scales\Scale::class, 'edit_faker',function (Faker $faker) {
    return [
        'id' => 1000,
        'code' => 789789,
        'ip_address' => '123456',
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
$factory->defineAs(App\Models\Governorate::class, 'demo_faker',function (Faker $faker) {
    return [
        'id' => 10001,
        'en_name'=>'Alex',
        'ar_name'=>'السكندرية'
    ];
});
