<?php

use Illuminate\Database\Seeder;

class SubMenusTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sub_menus')->delete();
        
        \DB::table('sub_menus')->insert(array (
            0 => 
            array (
                'id' => 1,
                'menu_group_id' => 1,
                'en_name' => 'Dashboard',
                'ar_name' => 'لوحة التحكم',
                'route' => 'home',
                'a_class' => 'sidebar-sub sidebar-sub-roles',
                'i_class' => 'simple-icon-user-following',
                'order' => 1,
                'created_at' => '2019-09-02 17:42:40',
                'updated_at' => '2019-09-02 17:42:41',
            ),
            1 => 
            array (
                'id' => 2,
                'menu_group_id' => 2,
                'en_name' => 'Roles',
                'ar_name' => 'الصلاحيات',
                'route' => 'roles.index',
                'a_class' => 'sidebar-sub sidebar-sub-roles',
                'i_class' => 'simple-icon-user-following',
                'order' => 1,
                'created_at' => '2019-09-02 17:42:40',
                'updated_at' => '2019-09-02 17:42:41',
            ),
            2 => 
            array (
                'id' => 3,
                'menu_group_id' => 2,
                'en_name' => 'Users',
                'ar_name' => 'المستخدمين',
                'route' => 'users.index',
                'a_class' => 'sidebar-sub sidebar-sub-users',
                'i_class' => 'simple-icon-user-follow',
                'order' => 2,
                'created_at' => '2019-09-02 17:42:40',
                'updated_at' => '2019-09-02 17:42:41',
            ),
            3 => 
            array (
                'id' => 4,
                'menu_group_id' => 3,
                'en_name' => 'Governorates',
                'ar_name' => 'المحافظات',
                'route' => 'governorates.index',
                'a_class' => 'sidebar-sub sidebar-sub-governorates',
                'i_class' => 'simple-icon-credit-card',
                'order' => 1,
                'created_at' => '2019-09-02 17:42:40',
                'updated_at' => '2019-09-02 17:42:41',
            ),
            4 => 
            array (
                'id' => 5,
                'menu_group_id' => 3,
                'en_name' => 'Cities',
                'ar_name' => 'المدن',
                'route' => 'cities.index',
                'a_class' => 'sidebar-sub sidebar-sub-cities',
                'i_class' => 'simple-icon-list',
                'order' => 2,
                'created_at' => '2019-09-02 17:42:40',
                'updated_at' => '2019-09-02 17:42:41',
            ),
            5 => 
            array (
                'id' => 6,
                'menu_group_id' => 3,
                'en_name' => 'Centers',
                'ar_name' => 'المراكز',
                'route' => 'centers.index',
                'a_class' => 'sidebar-sub sidebar-sub-centers',
                'i_class' => 'simple-icon-grid',
                'order' => 3,
                'created_at' => '2019-09-02 17:42:40',
                'updated_at' => '2019-09-02 17:42:41',
            ),
        ));
        
        
    }
}