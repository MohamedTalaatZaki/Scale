<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->defineAs(App\User::class, 'ahmed',function (Faker $faker) {
    $name = 'ahmed';
    $username = $name.'_'.$faker->regexify('[A-Za-z0-9]{20}');
    return [
      'full_name' => $name.' '.Str::random(5),
      'user_name' => $username,
      'email' => $username.'@admin.com',
      'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
      'remember_token' => Str::random(10),
      'lang' => 'ar',
      'is_active' => 1,
      'employee_code' => $faker->unique()->numberBetween(1, 100),
      'theme' => 'dark',
    ];
});


$factory->defineAs(App\User::class, 'test',function (Faker $faker) {
    $name = 'test';
    $username = $name.'_'.$faker->regexify('[A-Za-z0-9]{20}');
    return [
      'full_name' => $name.' '.Str::random(5),
      'user_name' => $username,
      'email' => $username.'@testuser.com',
      'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
      'remember_token' => Str::random(10),
      'lang' => 'ar',
      'employee_code' => $faker->unique()->numberBetween(1, 200),
      'theme' => 'light',
    ];
});


$factory->defineAs(App\User::class, 'admin',function (Faker $faker) {
    $name = 'admin';
    $username = $name.'_'.$faker->regexify('[A-Za-z0-9]{20}');
    return [
      'full_name' => $name.' '.Str::random(5),
      'user_name' => $username,
      'email' => $username.'@superadmin.com',
      'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
      'remember_token' => Str::random(10),
      'lang' => 'en',
      'is_active' => 1,
      'theme' => 'dark',
      'employee_code' => $faker->unique()->numberBetween(1, 300),
    ];
});
