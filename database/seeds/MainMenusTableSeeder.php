<?php

use App\Models\Roles\MainMenu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MainMenusTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        DB::table('main_menus')->truncate();
        DB::table('menu_groups')->truncate();
        DB::table('sub_menus')->truncate();

        $main = MainMenu::create([
            'en_name' => 'Dashboard',
            'ar_name' => 'لوحة التحكم',
            'class' => 'sidebar sidebar-dashboard',
            'href' => 'home',
            'sub_class' => 'iconsminds-shop-4',
            'data_link' => NULL,
        ]);
        $group = $main->menuGroups()->create([
            'en_name' => 'Dashboard',
            'ar_name' => 'لوحة التحكم',
            'aria_controls' => 'collapseAdministration',
            'order' => 1,
        ]);
        $group->subMenus()->createMany([
            [
                'en_name' => 'Dashboard',
                'ar_name' => 'لوحة التحكم',
                'route' => 'home',
                'a_class' => 'sidebar-sub sidebar-sub-roles',
                'i_class' => 'simple-icon-user-following',
                'order' => 1,
                'code'=>0
            ]
        ]);

        $main =  MainMenu::create([
            'en_name' => 'Master Data',
            'ar_name' => 'البيانات الاساسية',
            'class' => 'sidebar sidebar-master-data',
            'href' => '#masterData',
            'sub_class' => 'iconsminds-digital-drawing',
            'data_link' => 'masterData'
        ]);
        $group = $main->menuGroups()->create([
            'en_name' => 'Administration',
            'ar_name' => 'ادارة الصلاحيات والاعضاء',
            'aria_controls' => 'collapseAdministration',
            'order' => 1,
        ]);

        $group->subMenus()->createMany([
            [
                'en_name' => 'Users',
                'ar_name' => 'المستخدمين',
                'route' => 'users.index',
                'a_class' => 'sidebar-sub sidebar-sub-users',
                'i_class' => 'simple-icon-user-follow',
                'order' => 1,
                'code'=>1
            ],
            [
                'en_name' => 'Roles',
                'ar_name' => 'الصلاحيات',
                'route' => 'roles.index',
                'a_class' => 'sidebar-sub sidebar-sub-roles',
                'i_class' => 'simple-icon-user-following',
                'order' => 2,
                'code'=>2
            ]
        ]);
        $group = $main->menuGroups()->create([
            'en_name' => 'Governments',
            'ar_name' => 'المحافظات',
            'aria_controls' => 'collapseGovernorates',
            'order' => 2,
        ]);

        $group->subMenus()->createMany([
            [
                'en_name' => 'Governorates',
                'ar_name' => 'المحافظات',
                'route' => 'governorates.index',
                'a_class' => 'sidebar-sub sidebar-sub-governorates',
                'i_class' => 'simple-icon-credit-card',
                'order' => 1,
                'code'=>3
            ],
            [
                'menu_group_id' => 3,
                'en_name' => 'Cities',
                'ar_name' => 'المدن',
                'route' => 'cities.index',
                'a_class' => 'sidebar-sub sidebar-sub-cities',
                'i_class' => 'simple-icon-list',
                'order' => 2,
                'code'=>4

            ],
            [
                'menu_group_id' => 3,
                'en_name' => 'Centers',
                'ar_name' => 'المراكز',
                'route' => 'centers.index',
                'a_class' => 'sidebar-sub sidebar-sub-centers',
                'i_class' => 'simple-icon-grid',
                'order' => 3,
                'code'=>5
            ]
        ]);
        
    }
}