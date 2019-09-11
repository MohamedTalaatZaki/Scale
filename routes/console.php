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
        'id'=> 1003,
        'full_name'         =>  'testing',
        'user_name'         =>  'testing',
        'employee_number'   =>  10000,
        'email'             =>  'testing@test.com',
        'password'          =>  Hash::make(123456),
        'is_active'         => 0
    ]);
})->describe('Display an inspiring quote');

Artisan::command('test:delete_user', function () {
    optional(App\User::find(1003))->delete();
})->describe('Display an inspiring quote');

Artisan::command('test:delete_role', function () {
    optional(App\Models\Roles\Role::where('name','new'))->delete();
})->describe('delete role new');


Artisan::command('test:create_user_with_role', function () {
    $role = App\Models\Roles\Role::where('name','new')->first();
    DB::table('role_user')->insert([
        'user_id' =>  1004,
        'role_id' => $role->id
    ]);
})->describe('add role to user');

Artisan::command('test:create_user_radwa', function () {
    DB::table('users')->insert([
        'id'=> 1004,
        'full_name'         =>  'radwa',
        'user_name'         =>  'radwa',
        'employee_number'   =>  10004,
        'email'             =>  'radwa@test.com',
        'password'          =>  Hash::make(123456),
        'is_active'         => 1
    ]);
})->describe('Display an inspiring quote');

Artisan::command('test:delete_user_radwa', function () {
    optional(App\User::find(1004))->delete();
})->describe('Display an inspiring quote');


Artisan::command('test:delete_user_with_role', function () {
    $role = App\User::find(1004)->roles()->delete();
})->describe('delete role from user');


Artisan::command('user:add_permission_to_new {permission}', function ($permission) {
    $permission = Permission::where('name',$permission)->first();
    if(!is_null($permission)){
        $role = \App\Models\Roles\Role::where('name','new')->first();
        optional($role)->detachPermission($permission);
        optional($role)->attachPermission($permission);
    }
})->describe('Add permission to new role');





