<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->defineAs(App\Models\Items\Item::class, 'fake_items',function (Faker $faker) {
    return [
      'en_name' => $faker->regexify('[A-Za-z]{5}'),
      'ar_name' => Str::random(5),
      'item_group_id' => 10001,
      'sap_code' => 555,
      'item_type_id' => 2,
    ];
});

$factory->defineAs(App\Models\Items\Item::class, 'item_edit',function (Faker $faker) {
    return [
      'id' => 10001,
      'en_name' => $faker->regexify('[A-Za-z]{5}'),
      'ar_name' => Str::random(5),
      'item_group_id' => 10001,
      'sap_code' => 666,
      'item_type_id' => 2,
    ];
});

$factory->defineAs(App\Models\Items\Item::class, 'demo_faker',function (Faker $faker) {
    return [
      'id' => 1000,
      'en_name' => $faker->regexify('[A-Za-z]{5}'),
      'ar_name' => Str::random(5),
      'item_group_id' => 10001,
      'sap_code' => $faker->regexify('[A-Za-z]{5}'),
      'item_type_id' => 2,
    ];
});
