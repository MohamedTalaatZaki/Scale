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
