<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->defineAs(App\Models\Supplier\Supplier::class, 'fake_suppliers',function (Faker $faker) {
    return [
      'en_name' => $faker->unique()->regexify('[A-Za-z]{5}'),
      'ar_name' => $faker->unique()->regexify('[A-Za-z]{10}'),
      'sap_code'=> $faker->regexify('[A-Za-z]{5}'),
    ];
});
$factory->defineAs(App\Models\Supplier\Supplier::class, 'supplier_edit',function (Faker $faker) {
    return [
        'id' => 1000,
        'en_name'=>'Alexandria',
        'ar_name'=>'الإسكندرية',
        'sap_code' => 555,
    ];
});
