<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->defineAs(App\Models\Items\ItemGroup::class, 'demo_faker',function (Faker $faker) {
    return [
        'id' => 10001,
        'en_name'=>'group',
        'ar_name'=>'جروب',
        'testable' => 1
    ];
});

$factory->defineAs(App\Models\Items\ItemGroup::class, 'fake_item_groups',function (Faker $faker) {
    return [
      'en_name' => $faker->unique()->regexify('[A-Za-z]{5}'),
      'ar_name' => $faker->unique()->regexify('[A-Za-z]{10}'),
      'testable' => 1,
    ];
});
