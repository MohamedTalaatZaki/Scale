<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->defineAs(App\Models\City::class, 'city_edit',function (Faker $faker) {
    return [
        'id' => 1000,
        'gov_id'=>10001,
        'en_name'=>'Alexandria',
        'ar_name'=>'الإسكندرية'
    ];
});

$factory->defineAs(App\Models\City::class, 'fake_cities',function (Faker $faker) {
    return [
      'en_name' => $faker->regexify('[A-Za-z]{5}'),
      'ar_name' => Str::random(5),
      'gov_id' => 10001,
    ];
});
