<?php

use App\Models\Roles\Permission;
use App\Models\Roles\SubMenu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('permissions')->delete();

        Permission::create([
            'sub_menu_id' => 1,
            'name' => 'home',
            'en_display_name' => 'Home',
            'ar_display_name' => 'لوحة التحكم',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);

        $subMenu = SubMenu::where('code', 2)->first();
        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'roles.index',
            'en_display_name' => 'Roles Index',
            'ar_display_name' => 'عرض الصلاحيات',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);
        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'roles.create',
            'en_display_name' => 'Roles',
            'ar_display_name' => 'إضافة الصلاحيات',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);

        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'roles.edit',
            'en_display_name' => 'Roles',
            'ar_display_name' => 'تعديل الصلاحيات',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);

        $subMenu = SubMenu::where('code', 1)->first();

        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'users.index',
            'en_display_name' => 'Users',
            'ar_display_name' => 'عرض المستخدمين',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);

        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'users.create',
            'en_display_name' => 'Users',
            'ar_display_name' => 'إضافة المستخدمين',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);
        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'users.edit',
            'en_display_name' => 'Users',
            'ar_display_name' => 'تعديل المستخدمين',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);

        $subMenu = SubMenu::where('code', 3)->first();
        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'governorates.index',
            'en_display_name' => 'Governorate Index',
            'ar_display_name' => 'عرض المحافظات',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);
        Permission::create([
            'sub_menu_id' =>  $subMenu->id,

            'name' => 'governorates.create',
            'en_display_name' => 'Governorate Create',
            'ar_display_name' => 'إضافة المحافظات',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);
        Permission::create([
            'sub_menu_id' =>  $subMenu->id,
            'name' => 'governorates.edit',
            'en_display_name' => 'Governorate Edit',
            'ar_display_name' => 'تعديل المحافظات',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);

        $subMenu = SubMenu::where('code', 4)->first();

        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'cities.index',
            'en_display_name' => 'Cities Index',
            'ar_display_name' => 'عرض المدن',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);
        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'cities.create',
            'en_display_name' => 'Cities Create',
            'ar_display_name' => 'إضافة المدن',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);
        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'cities.edit',
            'en_display_name' => 'Cities Edit',
            'ar_display_name' => 'تعديل المدن',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);
        $subMenu = SubMenu::where('code', 5)->first();

        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'centers.index',
            'en_display_name' => 'Centers Index',
            'ar_display_name' => 'عرض المراكز',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);
        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'centers.create',
            'en_display_name' => 'Centers Create',
            'ar_display_name' => 'إضافة المراكز',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);
        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'centers.edit',
            'en_display_name' => 'Centers Edit',
            'ar_display_name' => 'تعديل المراكز',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);


    }
}