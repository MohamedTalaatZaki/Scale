<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->defineAs(App\Models\Governorate::class, 'fake_gov',function (Faker $faker) {
    return [
      'en_name' => $faker->unique()->regexify('[A-Za-z]{5}'),
      'ar_name' => $faker->unique()->regexify('[A-Za-z]{10}'),
    ];
});
$factory->defineAs(App\Models\Governorate::class, 'gov_edit',function (Faker $faker) {
    return [
        'id' => 1000,
        'en_name'=>'Alexandria',
        'ar_name'=>'الإسكندرية'
    ];
});
$factory->defineAs(App\Models\Governorate::class, 'demo_faker',function (Faker $faker) {
    return [
        'id' => 10001,
        'en_name'=>'Alex',
        'ar_name'=>'السكندرية'
    ];
});
