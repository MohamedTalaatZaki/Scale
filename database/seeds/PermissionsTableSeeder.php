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
        $subMenu = SubMenu::where('code', 0)->first();
        Permission::create([
            'sub_menu_id' => $subMenu->id,
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
            'en_display_name' => 'List Roles',
            'ar_display_name' => 'عرض الصلاحيات',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);
        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'roles.create',
            'en_display_name' => 'Add Roles',
            'ar_display_name' => 'إضافة الصلاحيات',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);

        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'roles.edit',
            'en_display_name' => 'Edit Roles',
            'ar_display_name' => 'تعديل الصلاحيات',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);

        $subMenu = SubMenu::where('code', 1)->first();

        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'users.index',
            'en_display_name' => 'List Users',
            'ar_display_name' => 'عرض المستخدمين',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);

        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'users.create',
            'en_display_name' => 'Add Users',
            'ar_display_name' => 'إضافة المستخدمين',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);
        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'users.edit',
            'en_display_name' => 'Edit Users',
            'ar_display_name' => 'تعديل المستخدمين',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);

        $subMenu = SubMenu::where('code', 3)->first();
        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'governorates.index',
            'en_display_name' => 'List Governorate',
            'ar_display_name' => 'عرض المحافظات',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);
        Permission::create([
            'sub_menu_id' =>  $subMenu->id,

            'name' => 'governorates.create',
            'en_display_name' => 'Create Governorate',
            'ar_display_name' => 'إضافة المحافظات',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);
        Permission::create([
            'sub_menu_id' =>  $subMenu->id,
            'name' => 'governorates.edit',
            'en_display_name' => 'Edit Governorate',
            'ar_display_name' => 'تعديل المحافظات',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);

        $subMenu = SubMenu::where('code', 4)->first();

        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'cities.index',
            'en_display_name' => 'List Cities',
            'ar_display_name' => 'عرض المدن',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);
        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'cities.create',
            'en_display_name' => 'Create Cities',
            'ar_display_name' => 'إضافة المدن',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);
        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'cities.edit',
            'en_display_name' => 'Edit Cities',
            'ar_display_name' => 'تعديل المدن',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);
        $subMenu = SubMenu::where('code', 5)->first();

        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'centers.index',
            'en_display_name' => 'List Centers',
            'ar_display_name' => 'عرض المراكز',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);
        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'centers.create',
            'en_display_name' => 'Create Centers',
            'ar_display_name' => 'إضافة المراكز',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);
        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'centers.edit',
            'en_display_name' => 'Edit Centers',
            'ar_display_name' => 'تعديل المراكز',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);


        $subMenu = SubMenu::where('code', 6)->first();

        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'item-group.index',
            'en_display_name' => 'List Item Groups',
            'ar_display_name' => 'عرض مجموعات الاصناف',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);
        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'item-group.create',
            'en_display_name' => 'Create Item Groups',
            'ar_display_name' => 'إضافة مجموعات الاصناف',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);
        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'item-group.edit',
            'en_display_name' => 'Edit Item Groups',
            'ar_display_name' => 'تعديل مجموعات الاصناف',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);


        $subMenu = SubMenu::where('code', 7)->first();

        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'item-types.index',
            'en_display_name' => 'List Item Types',
            'ar_display_name' => 'عرض أنواع الاصناف',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);
        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'item-types.create',
            'en_display_name' => 'Create Item Types',
            'ar_display_name' => 'إضافة أنواع الاصناف',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);
        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'item-types.edit',
            'en_display_name' => 'Edit Item Types',
            'ar_display_name' => 'تعديل أنواع الاصناف',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);

        $subMenu = SubMenu::where('code', 8)->first();

        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'items.index',
            'en_display_name' => 'List Items',
            'ar_display_name' => 'عرض الاصناف',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);
        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'items.create',
            'en_display_name' => 'Create Item',
            'ar_display_name' => 'إضافة صنف',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);
        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'items.edit',
            'en_display_name' => 'Edit Item',
            'ar_display_name' => 'تعديل صنف',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);

        $subMenu = SubMenu::where('code', 9)->first();

        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'suppliers.index',
            'en_display_name' => 'List Suppliers',
            'ar_display_name' => 'عرض الموردين',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);
        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'suppliers.create',
            'en_display_name' => 'Create Supplier',
            'ar_display_name' => 'إضافة مورد',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);
        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'suppliers.edit',
            'en_display_name' => 'Edit Supplier',
            'ar_display_name' => 'تعديل مورد',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);
        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'suppliers.delete',
            'en_display_name' => 'Delete Supplier',
            'ar_display_name' => 'حذف مورد',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);


    }
}
