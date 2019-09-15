<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->defineAs(App\Models\Items\ItemType::class, 'fake_item_types',function (Faker $faker) {
    return [
      'en_name' => $faker->unique()->regexify('[A-Za-z]{5}'),
      'ar_name' => $faker->unique()->regexify('[A-Za-z]{10}'),
    ];
});
$factory->defineAs(App\Models\Items\ItemType::class, 'item_type_edit',function (Faker $faker) {
    return [
        'id' => 1000,
        'en_name'=>'Alexandria',
        'ar_name'=>'الإسكندرية'
    ];
});
