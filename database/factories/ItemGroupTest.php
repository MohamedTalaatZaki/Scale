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
