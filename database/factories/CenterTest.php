<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->defineAs(App\Models\Center::class, 'center_edit',function (Faker $faker) {
    return [
        'id' => 1000,
        'city_id'=>1000,
        'is_active'=>1,
        'en_name'=>'Alexandria',
        'ar_name'=>'الإسكندرية'
    ];
});

$factory->defineAs(App\Models\Center::class, 'center_demo',function (Faker $faker) {
    return [
        'id' => 1000,
        'city_id'=>1,
        'is_active'=>1,
        'en_name'=>'Alexandria',
        'ar_name'=>'الإسكندرية'
    ];
});

$factory->defineAs(App\Models\Center::class, 'fake_centers',function (Faker $faker) {
    return [
      'en_name' => $faker->regexify('[A-Za-z]{5}'),
      'ar_name' => Str::random(5),
      'city_id' => 1000,
      'is_active' => 1
    ];
});
