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
