<?php

use App\Models\Roles\Permission;
use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('user:add_permission {permission}', function ($permission) {
    $permission = Permission::where('name',$permission)->first();
    if(!is_null($permission)){
        $role = \App\Models\Roles\Role::where('name','test')->first();
        optional($role)->detachPermission($permission);
        optional($role)->attachPermission($permission);
    }
})->describe('Add permission to test role');

Artisan::command('user:remove_permission {permission}', function ($permission) {
    $permission = Permission::where('name',$permission)->first();
    if(!is_null($permission)){
        $role = \App\Models\Roles\Role::where('name','test')->first();
        optional($role)->detachPermission($permission);
    }
})->describe('remove permission to test role');




Artisan::command('test:create_user', function () {
    DB::table('users')->insert([
        'id'=> 1000,
        'full_name'         =>  'test',
        'user_name'         =>  'test',
        'employee_number'   =>  10000,
        'email'             =>  'test@test.com',
        'password'          =>  Hash::make(123456),
        'is_active'         => 0
    ]);
})->describe('creates user 1');

Artisan::command('test:delete_user', function () {
    optional(User::find(1000))->delete();
})->describe('delete user 1');



Artisan::command('test:create_user2', function () {
    DB::table('users')->insert([
        'id'=> 1001,
        'full_name'         =>  'test2',
        'user_name'         =>  'test2',
        'employee_number'   =>  10001,
        'email'             =>  'test2@test.com',
        'password'          =>  Hash::make(123456),
        'is_active'         => 0
    ]);
})->describe('creates user 2');

Artisan::command('test:delete_user2', function () {
    optional(User::find(1001))->delete();
})->describe('delete user 2');

Artisan::command('test:delete_role_new', function () {
    optional(role::find('new'))->delete();
})->describe('delete role new');

