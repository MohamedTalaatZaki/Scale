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
            'sub_class' => 'dashboardIcon',
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
                'i_class' => 'dashboardIcon',
                'order' => 1,
                'code'=>0
            ]
        ]);

        $main =  MainMenu::create([
            'en_name' => 'Master Data',
            'ar_name' => 'البيانات الاساسية',
            'class' => 'sidebar sidebar-master-data',
            'href' => '#masterData',
            'sub_class' => 'masterDataIcon',
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
                'i_class' => 'usersIcon',
                'order' => 1,
                'code'=>1
            ],
            [
                'en_name' => 'Roles',
                'ar_name' => 'الصلاحيات',
                'route' => 'roles.index',
                'a_class' => 'sidebar-sub sidebar-sub-roles',
                'i_class' => 'rolesIcon',
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
                'i_class' => 'governoratesIcon',
                'order' => 1,
                'code'=>3
            ],
            [
                'menu_group_id' => 3,
                'en_name' => 'Cities',
                'ar_name' => 'المدن',
                'route' => 'cities.index',
                'a_class' => 'sidebar-sub sidebar-sub-cities',
                'i_class' => 'citiesIcon',
                'order' => 2,
                'code'=>4

            ],
            [
                'menu_group_id' => 3,
                'en_name' => 'Centers',
                'ar_name' => 'المراكز',
                'route' => 'centers.index',
                'a_class' => 'sidebar-sub sidebar-sub-centers',
                'i_class' => 'centersIcon',
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
                'i_class' => 'itemGroupsIcon',
                'order' => 1,
                'code'=>6
            ],
            [
                'en_name' => 'Item Types',
                'ar_name' => 'أنواع الاصناف',
                'route' => 'item-types.index',
                'a_class' => 'sidebar-sub sidebar-sub-item-types',
                'i_class' => 'itemTypesIcon',
                'order' => 2,
                'code'=>7
            ],
            [
                'en_name' => 'Items',
                'ar_name' => 'الاصناف',
                'route' => 'items.index',
                'a_class' => 'sidebar-sub sidebar-sub-items',
                'i_class' => 'itemsIcon',
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
                'i_class' => 'suppliersIcon',
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
                'i_class' => 'scalesIcon',
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
                'en_name' => 'QC Elements',
                'ar_name' => 'عناصر مراقبة الجودة',
                'route' => 'qc-elements.index',
                'a_class' => 'sidebar-sub sidebar-sub-qc-elements',
                'i_class' => 'qcElementsIcon',
                'order' => 1,
                'code'=>11
            ]
        ]);

        $group->subMenus()->createMany([
            [
                'en_name' => 'QC Test',
                'ar_name' => 'أختبارات مراقبة الجودة',
                'route' => 'qc-test-headers.index',
                'a_class' => 'sidebar-sub sidebar-sub-qc-test-headers',
                'i_class' => 'qcTestIcon',
                'order' => 1,
                'code'=>12
            ]
        ]);

        $main =  MainMenu::create([
            'en_name' => 'Security',
            'ar_name' => 'الأمن',
            'class' => 'sidebar sidebar-security',
            'href' => '#security',
            'sub_class' => 'securityIcon',
            'data_link' => 'security'
        ]);
        $group = $main->menuGroups()->create([
            'en_name' => 'Truck Arrival',
            'ar_name' => 'وصول الشاحنات',
            'aria_controls' => 'collapseTransports',
            'order' => 1,
        ]);
        $group->subMenus()->createMany([
            [
                'en_name' => 'Truck Arrival',
                'ar_name' => 'وصول الشاحنات',
                'route' => 'transports.index',
                'a_class' => 'sidebar-sub sidebar-sub-transports',
                'i_class' => 'truckArrivalIcon',
                'order' => 1,
                'code'=>13
            ],
            [
                'en_name' => 'Blocked Drivers',
                'ar_name' => 'السائقين المحظورين',
                'route' => 'blocked-drivers.index',
                'a_class' => 'sidebar-sub sidebar-sub-blocked-drivers',
                'i_class' => 'blockedDriversIcon',
                'order' => 1,
                'code'=>20
            ]
        ]);

        $main =  MainMenu::create([
            'en_name' => 'Quality Control',
            'ar_name' => 'مراقبة الجودة',
            'class' => 'sidebar sidebar-qc',
            'href' => '#qualityControl',
            'sub_class' => 'qualityControlIcon',
            'data_link' => 'qualityControl'
        ]);
        $group = $main->menuGroups()->create([
            'en_name' => 'Arrived Trucks',
            'ar_name' => 'شاحنات بالانتظار',
            'aria_controls' => 'collapseArrivedTrucks',
            'order' => 1,
        ]);
        $group->subMenus()->createMany([
            [
                'en_name' => 'Arrived Trucks',
                'ar_name' => 'شاحنات بالانتظار',
                'route' => 'arrived-trucks.index',
                'a_class' => 'sidebar-sub sidebar-sub-arrived-trucks',
                'i_class' => 'arrivedTrucksIcon',
                'order' => 1,
                'code'=>14
            ],
            [
                'en_name' => 'Sampled Tests',
                'ar_name' => 'العينات المختبره',
                'route' => 'samples-test.index',
                'a_class' => 'sidebar-sub sidebar-sub-sampled-tests',
                'i_class' => 'sampledTestIcon',
                'order' => 1,
                'code'=>15
            ],
            [
                'en_name' => 'Edit Trucks Queue',
                'ar_name' => 'ترتيب دخول الشاحنات',
                'route' => 'edit-queue.index',
                'a_class' => 'sidebar-sub sidebar-sub-edit-queue',
                'i_class' => 'EditTruckQueueIcon',
                'order' => 1,
                'code'=>16
            ],
        ]);

        $main =  MainMenu::create([
            'en_name' => 'Production',
            'ar_name' => 'الانتاج',
            'class' => 'sidebar sidebar-production',
            'href' => '#production',
            'sub_class' => 'productionIcon',
            'data_link' => 'production'
        ]);
        $group = $main->menuGroups()->create([
            'en_name' => 'Production Process',
            'ar_name' => 'الانتاج',
            'aria_controls' => 'collapseProductionProcess',
            'order' => 1,
        ]);
        $group->subMenus()->createMany([
            [
                'en_name' => 'Raw Process',
                'ar_name' => 'عمليات الخامات',
                'route' => 'production-process.index',
                'a_class' => 'sidebar-sub sidebar-sub-production-process',
                'i_class' => 'rawProcessIcon',
                'order' => 1,
                'code'=>17
            ],
            [
                'en_name' => 'Scrap Process',
                'ar_name' => 'عمليات المخلفات',
                'route' => 'scrap-process.index',
                'a_class' => 'sidebar-sub sidebar-sub-scrap-process',
                'i_class' => 'scrapProcessIcon',
                'order' => 1,
                'code'=>18
            ],
            [
                'en_name' => 'Finish Process',
                'ar_name' => 'عمليات المنتج التام',
                'route' => 'finish-process.index',
                'a_class' => 'sidebar-sub sidebar-sub-finish-process',
                'i_class' => 'finishProcessIcon',
                'order' => 1,
                'code'=>21
            ]
        ]);

        $group = $main->menuGroups()->create([
            'en_name' => 'Manual Scale',
            'ar_name' => 'الميزان',
            'aria_controls' => 'collapseManualScale',
            'order' => 1,
        ]);
        $group->subMenus()->createMany([
            [
                'en_name' => 'Scale',
                'ar_name' => 'الميزان',
                'route' => 'trucks-scale.index',
                'a_class' => 'sidebar-sub sidebar-sub-manual-scale',
                'i_class' => 'scaleIcon',
                'order' => 1,
                'code'=>19
            ]
        ]);

        $group = $main->menuGroups()->create([
            'en_name' => 'Trucks Summary',
            'ar_name' => 'ملخص العمليات',
            'aria_controls' => 'collapseTrucksSummary',
            'order' => 1,
        ]);
        
        $group->subMenus()->createMany([
            [
                'en_name' => 'Trucks Summery',
                'ar_name' => 'ملخص العمليات',
                'route' => 'truck-summary.index',
                'a_class' => 'sidebar-sub sidebar-sub-truck-summary',
                'i_class' => 'truckSummaryIcon',
                'order' => 1,
                'code'=>22
            ]
        ]);
    }

     //permission code next = 23 ;
}
