<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('permissions')->delete();
        
        \DB::table('permissions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'sub_menu_id' => 1,
                'name' => 'home',
                'en_display_name' => 'Home',
                'ar_display_name' => 'لوحة التحكم',
                'en_description' => NULL,
                'ar_description' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'sub_menu_id' => 2,
                'name' => 'roles.index',
                'en_display_name' => 'Roles Index',
                'ar_display_name' => 'عرض الصلاحيات',
                'en_description' => NULL,
                'ar_description' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'sub_menu_id' => 2,
                'name' => 'roles.create',
                'en_display_name' => 'Roles',
                'ar_display_name' => 'عرض الصلاحيات',
                'en_description' => NULL,
                'ar_description' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'sub_menu_id' => 2,
                'name' => 'roles.edit',
                'en_display_name' => 'Roles',
                'ar_display_name' => 'عرض الصلاحيات',
                'en_description' => NULL,
                'ar_description' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'sub_menu_id' => 3,
                'name' => 'users.index',
                'en_display_name' => 'Users',
                'ar_display_name' => 'عرض الصلاحيات',
                'en_description' => NULL,
                'ar_description' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'sub_menu_id' => 3,
                'name' => 'users.create',
                'en_display_name' => 'Users',
                'ar_display_name' => 'عرض الصلاحيات',
                'en_description' => NULL,
                'ar_description' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'sub_menu_id' => 3,
                'name' => 'users.edit',
                'en_display_name' => 'Users',
                'ar_display_name' => 'عرض الصلاحيات',
                'en_description' => NULL,
                'ar_description' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'sub_menu_id' => 4,
                'name' => 'governorates.index',
                'en_display_name' => 'Governorate Index',
                'ar_display_name' => 'المحافظات',
                'en_description' => NULL,
                'ar_description' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'sub_menu_id' => 4,
                'name' => 'governorates.create',
                'en_display_name' => 'Governorate Create',
                'ar_display_name' => 'المحافظات',
                'en_description' => NULL,
                'ar_description' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'sub_menu_id' => 4,
                'name' => 'governorates.edit',
                'en_display_name' => 'Governorate Edit',
                'ar_display_name' => 'المحافظات',
                'en_description' => NULL,
                'ar_description' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'sub_menu_id' => 5,
                'name' => 'cities.index',
                'en_display_name' => 'Cities Index',
                'ar_display_name' => 'المدن',
                'en_description' => NULL,
                'ar_description' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'sub_menu_id' => 5,
                'name' => 'cities.create',
                'en_display_name' => 'Cities Create',
                'ar_display_name' => 'المدن',
                'en_description' => NULL,
                'ar_description' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'sub_menu_id' => 5,
                'name' => 'cities.edit',
                'en_display_name' => 'Cities Edit',
                'ar_display_name' => 'المدن',
                'en_description' => NULL,
                'ar_description' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'sub_menu_id' => 6,
                'name' => 'centers.index',
                'en_display_name' => 'Centers Index',
                'ar_display_name' => 'المراكز',
                'en_description' => NULL,
                'ar_description' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'sub_menu_id' => 6,
                'name' => 'centers.create',
                'en_display_name' => 'Centers Create',
                'ar_display_name' => 'المراكز',
                'en_description' => NULL,
                'ar_description' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            15 => 
            array (
                'id' => 16,
                'sub_menu_id' => 6,
                'name' => 'centers.edit',
                'en_display_name' => 'Centers Edit',
                'ar_display_name' => 'المراكز',
                'en_description' => NULL,
                'ar_description' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}