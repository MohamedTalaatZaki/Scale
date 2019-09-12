<?php

use App\User;
use App\Models\Roles\Permission;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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

Artisan::command('test:create_user', function () {
    DB::table('users')->insert([
        'id'=> 10003,
        'full_name'         =>  'test1',
        'user_name'         =>  'testing1',
        'employee_code'   =>  100003,
        'email'             =>  'test1@testing.com',
        'password'          =>  Hash::make(123456),
        'is_active'         => 1
    ]);
})->describe('Display an inspiring quote');

Artisan::command('test:delete_user', function () {
    optional(User::find(10003))->delete();
})->describe('Display an inspiring quote');





Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('test:create_user2', function () {
    DB::table('users')->insert([
        'id'=> 1001,
        'full_name'         =>  'test2',
        'user_name'         =>  'test2',
        'employee_code'   =>  10001,
        'email'             =>  'test2@test.com',
        'password'          =>  Hash::make(123456),
        'is_active'         => 0
    ]);
})->describe('Display an inspiring quote');

Artisan::command('test:delete_user2', function () {
    optional(User::find(1001))->delete();
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


Artisan::command('test:create_role_testing', function () {
    DB::table('roles')->insert([
        'id' => '9999',
        'name' => 'testing',
        'display_name' => NULL,
        'description' => NULL,
        'is_active' => 1,
        'is_admin'=>0
    ]);
})->describe('Display an inspiring quote');

Artisan::command('test:delete_role', function () {
    optional(App\Models\Roles\Role::find(9999))->delete();
})->describe('Display an inspiring quote');




Artisan::command('test:create_user_with_role', function () {
    $role = App\Models\Roles\Role::where('name','testing')->first();
    DB::table('role_user')->insert([
        'user_id' =>  10003,
        'role_id' => $role->id
    ]);
    })->describe('add role to user');
