<?php

use App\User;
use App\Models\Roles\Permission;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
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
        'id'=> 1000,
        'full_name'         =>  'test',
        'user_name'         =>  'testing',
        'employee_code'   =>  10000,
        'email'             =>  'test@testing.com',
        'password'          =>  Hash::make(123456),
        'is_active'         => 0
    ]);
})->describe('Display an inspiring quote');

Artisan::command('test:delete_user', function () {
    optional(User::find(1000))->delete();
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

Artisan::command('user:faker_ahmed', function () {
    $users = factory(App\User::class, 'ahmed',100)->create();
})->describe('Generate fake users');


Artisan::command('user:faker_test', function () {
    $users = factory(App\User::class, 'admin',100)->create();
})->describe('Generate fake test users');


Artisan::command('user:faker_admin', function () {
    $users = factory(App\User::class, 'test',100)->create();
})->describe('Generate fake admin users');

Artisan::command('role:faker', function () {
    $roles = factory(App\Models\Roles\Role::class,'fake_roles',300)->create();
})->describe('Generate fake roles');


Artisan::command('governorate:create_faker', function () {
    $gov = factory(App\Models\Governorate::class)->create();
})->describe('Generate fake single governorate');

Artisan::command('governorate:demo_faker', function () {
    $gov = factory(App\Models\Governorate::class,'demo_faker')->create();
})->describe('Generate fake single governorate');

Artisan::command('governorate:edit_faker', function () {
    $gov = factory(App\Models\Governorate::class,'gov_edit')->create();
})->describe('Generate fake governorate for edit');

Artisan::command('city:edit_faker', function () {
    $city = factory(App\Models\City::class,'city_edit')->create();
})->describe('Generate fake city for edit');

Artisan::command('center:edit_faker', function () {
    $center = factory(App\Models\Center::class,'center_edit')->create();
})->describe('Generate fake center for edit');

Artisan::command('city:faker', function () {
    $cities = factory(App\Models\City::class,'fake_cities',300)->create();
})->describe('Generate fake cities');

Artisan::command('center:faker', function () {
    $centers = factory(App\Models\Center::class,'fake_centers',300)->create();
})->describe('Generate fake centers');

Artisan::command('governorate:faker', function () {
    $governorates = factory(App\Models\Governorate::class,'fake_gov',300)->create();
})->describe('Generate fake governorates');

Artisan::command('item_type:faker', function () {
    $item_types = factory(App\Models\Items\ItemType::class,'fake_item_types',300)->create();
})->describe('Generate fake Item Types');

Artisan::command('item:faker', function () {
    $cities = factory(App\Models\Items\Item::class,'fake_items',300)->create();
})->describe('Generate fake items');

Artisan::command('supplier:edit_faker', function () {
    $item_type = factory(App\Models\Supplier\Supplier::class,'supplier_edit')->create();
})->describe('Generate fake Supplier for edit');

Artisan::command('supplier:fake_many', function () {
    $suppliers = factory(App\Models\Supplier\Supplier::class,'fake_suppliers',300)->create();
})->describe('Generate fake suppliers');

Artisan::command('item:fake_items', function () {
    $suppliers = factory(App\Models\Items\Item::class,'fake_items',300)->create();
})->describe('Generate fake items');

Artisan::command('item_type:edit_faker', function () {
    $item_type = factory(App\Models\Items\ItemType::class,'item_type_edit')->create();
})->describe('Generate fake Item Type for edit');

Artisan::command('item_group:fake_item_groups', function () {
    $item_groups = factory(App\Models\Items\ItemGroup::class,'fake_item_groups',300)->create();
})->describe('Generate fake item groups');

Artisan::command('item_group:demo_faker', function () {
    $item_groups = factory(App\Models\Items\ItemGroup::class,'demo_faker')->create();
})->describe('Generate fake single item group');

Artisan::command('item:demo_faker', function () {
    $items = factory(App\Models\Items\Item::class,'demo_faker')->create();
})->describe('Generate fake single item');

Artisan::command('item:edit_faker', function () {
    $item = factory(App\Models\Items\Item::class,'item_edit')->create();
})->describe('Generate fake item for edit');

Artisan::command('user:setLocale {lang}',function($lang){
    App\User::where('user_name','test')->update([
        'lang' => $lang,
      ]);
})->describe('Change Locale Language');




Artisan::command('test:create_user', function () {
    DB::table('users')->insert([
        'id'=> 1003,
        'full_name'         =>  'testing',
        'user_name'         =>  'testing',
        'employee_code'   =>  10000,
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
        'employee_code'   =>  10004,
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


Artisan::command('user:revoke_permission_to_new {permission}', function ($permission) {
    $permission = Permission::where('name',$permission)->first();
    if(!is_null($permission)){
        $role = \App\Models\Roles\Role::where('name','new')->first();
        optional($role)->detachPermission($permission);
    }
})->describe('Revoke permission to new role');


Artisan::command('test:create_item_group', function () {
    DB::table('item_group')->insert([
        'id'=> 123456,
        'ar_name'         =>  'رتقال',
        'en_name'         =>  'orange',
        'testable'   =>  0,
    ]);
})->describe('create item type');

Artisan::command('test:delete_item_group', function () {
    optional(App\Models\items\itemGroup::find(123456))->delete();
})->describe('delete item group');



Artisan::command('test:delete_scale', function () {
    optional(App\Models\Scales\Scale::where('ip_address','888'))->delete();
})->describe('delete scale');

Artisan::command('test:delete_scale2', function () {
    optional(App\Models\Scales\Scale::where('ip_address','8888'))->delete();
})->describe('delete scale2');

Artisan::command('test:create_scale_test', function () {
    DB::table('scales')->insert([
        'id'=> 1234,
        'code'         =>  '9999',
        'ip_address'         =>  '9999',
        'is_active'   =>  0,
        'com_port'=> '1234',
        'baud_rate'         =>  '75',
        'byte_size'         =>  'FIVE BITS',
        'brand'         =>  '9999',
        'stop_bits'   =>  'STOP BITS ONE',
        'parity'   =>  'PARITY EVEN',

    ]);
})->describe('create scale test');

Artisan::command('test:delete_scale_test', function () {
    optional(App\Models\Scales\Scale::where('ip_address','9999'))->delete();
})->describe('delete scale2');

Artisan::command('test:delete_scale3', function () {
    optional(App\Models\Scales\Scale::where('code','12345'))->delete();
})->describe('delete scale2');
