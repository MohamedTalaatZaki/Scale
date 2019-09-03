<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Government;
use Faker\Generator as Faker;

$factory->define(Government::class, function (Faker $faker) {
    return [
        'en_name'=>'Alexandria',
        'ar_name'=>'الإسكندرية'
    ];

});
