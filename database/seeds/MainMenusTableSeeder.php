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
            'ar_name' => 'اللوحة الرئيسية',
            'class' => 'sidebar sidebar-dashboard',
            'href' => 'home',
            'sub_class' => 'iconsminds-shop-4',
            'data_link' => NULL,
        ]);
        $group = $main->menuGroups()->create([
            'en_name' => 'Dashboard',
            'ar_name' => 'اللوحة الرئيسية',
            'aria_controls' => 'collapseAdministration',
            'order' => 1,
        ]);
        $group->subMenus()->createMany([
            [
                'en_name' => 'Dashboard',
                'ar_name' => 'اللوحة الرئيسية',
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
            'ar_name' => 'ادارة الصلاحيات و المستخدمين',
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

        $group = $main->menuGroups()->create([
            'en_name' => 'Items',
            'ar_name' => 'الاصناف',
            'aria_controls' => 'collapseItems',
            'order' => 3,
        ]);

        $group->subMenus()->createMany([
            [
                'en_name' => 'Item Groups',
                'ar_name' => 'مجموعات الاصناف',
                'route' => 'item-group.index',
                'a_class' => 'sidebar-sub sidebar-sub-item-group',
                'i_class' => 'simple-icon-user-follow',
                'order' => 1,
                'code'=>6
            ],
            [
                'en_name' => 'Item Types',
                'ar_name' => 'أنواع الاصناف',
                'route' => 'item-types.index',
                'a_class' => 'sidebar-sub sidebar-sub-item-types',
                'i_class' => 'simple-icon-user-follow',
                'order' => 2,
                'code'=>7
            ],
            [
                'en_name' => 'Items',
                'ar_name' => 'الاصناف',
                'route' => 'items.index',
                'a_class' => 'sidebar-sub sidebar-sub-items',
                'i_class' => 'simple-icon-user-follow',
                'order' => 3,
                'code'=>8
            ]
        ]);

        $group = $main->menuGroups()->create([
            'en_name' => 'Suppliers',
            'ar_name' => 'الموردين',
            'aria_controls' => 'collapseSuppliers',
            'order' => 4,
        ]);

        $group->subMenus()->createMany([
            [
                'en_name' => 'Suppliers',
                'ar_name' => 'الموردين',
                'route' => 'suppliers.index',
                'a_class' => 'sidebar-sub sidebar-sub-suppliers',
                'i_class' => 'simple-icon-user-follow',
                'order' => 1,
                'code'=>9
            ]
        ]);

        $group = $main->menuGroups()->create([
            'en_name' => 'Scales',
            'ar_name' => 'الموازين',
            'aria_controls' => 'collapseScales',
            'order' => 5,
        ]);

        $group->subMenus()->createMany([
            [
                'en_name' => 'Scales',
                'ar_name' => 'الموازين',
                'route' => 'scales.index',
                'a_class' => 'sidebar-sub sidebar-sub-scales',
                'i_class' => 'simple-icon-user-follow',
                'order' => 1,
                'code'=>10
            ]
        ]);

        $group = $main->menuGroups()->create([
            'en_name' => 'QC Test',
            'ar_name' => 'أختبارات مراقبة الجودة',
            'aria_controls' => 'collapseQcTest',
            'order' => 6,
        ]);

        $group->subMenus()->createMany([
            [
                'en_name' => 'QC Test',
                'ar_name' => 'أختبارات مراقبة الجودة',
                'route' => 'qc-test-headers.index',
                'a_class' => 'sidebar-sub sidebar-sub-qc-test-headers',
                'i_class' => 'simple-icon-user-follow',
                'order' => 1,
                'code'=>11
            ]
        ]);

        $main =  MainMenu::create([
            'en_name' => 'Security',
            'ar_name' => 'الأمن',
            'class' => 'sidebar sidebar-security',
            'href' => '#sercurity',
            'sub_class' => 'iconsminds-digital-drawing',
            'data_link' => 'security'
        ]);
        $group = $main->menuGroups()->create([
            'en_name' => 'Truck Arrival',
            'ar_name' => 'وصول الشاحنات',
            'aria_controls' => 'collapseTruckArrival',
            'order' => 1,
        ]);
        $group->subMenus()->createMany([
            [
                'en_name' => 'Truck Arrival',
                'ar_name' => 'وصول الشاحنات',
                'route' => 'trucks-arrival.index',
                'a_class' => 'sidebar-sub sidebar-sub-trucks-arrival',
                'i_class' => 'simple-icon-user-follow',
                'order' => 1,
                'code'=>12
            ]
        ]);
    }
}
