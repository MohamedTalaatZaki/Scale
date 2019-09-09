<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Governorate;
use Faker\Generator as Faker;

$factory->define(Governorate::class, function (Faker $faker) {
    return [
        'en_name'=>'Alexandria',
        'ar_name'=>'الإسكندرية'
    ];

});
