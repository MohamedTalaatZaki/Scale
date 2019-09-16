<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->defineAs(App\Models\Roles\Role::class, 'fake_roles',function (Faker $faker) {
    return [
      'name' => $faker->unique()->regexify('[A-Za-z]{5}'),
      'display_name' => Str::random(5),
      'is_active' => 1,
    ];
});
