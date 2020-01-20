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


        DB::table('permissions')->truncate();
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

        $subMenu = SubMenu::where('code', 10)->first();

        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'scales.index',
            'en_display_name' => 'List Scales',
            'ar_display_name' => 'عرض الموازين',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);
        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'scales.create',
            'en_display_name' => 'Create Scales',
            'ar_display_name' => 'إضافة ميزان',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);
        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'scales.edit',
            'en_display_name' => 'Edit Scales',
            'ar_display_name' => 'تعديل ميزان',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);
        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'scales.delete',
            'en_display_name' => 'Delete Scales',
            'ar_display_name' => 'حذف ميزان',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);

        $subMenu = SubMenu::where('code', 11)->first();

        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'qc-elements.index',
            'en_display_name' => 'List Qc Elements',
            'ar_display_name' => 'عرض عناصر مراقبة الجودة',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);
        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'qc-elements.create',
            'en_display_name' => 'Create Qc Elements',
            'ar_display_name' => 'إضافة عنصر مراقبة الجودة',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);
        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'qc-elements.edit',
            'en_display_name' => 'Edit Qc Elements',
            'ar_display_name' => 'تعديل عنصر مراقبة الجودة',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);
        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'qc-elements.delete',
            'en_display_name' => 'Delete Qc Elements',
            'ar_display_name' => 'حذف عنصر مراقبة الجودة',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);

        $subMenu = SubMenu::where('code', 12)->first();
        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'qc-test-headers.index',
            'en_display_name' => 'List Qc Test',
            'ar_display_name' => 'عرض أختبارات مراقبة الجودة',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);
        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'qc-test-headers.create',
            'en_display_name' => 'Create Qc Test',
            'ar_display_name' => 'إضافة اختبار مراقبة الجودة',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);
        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'qc-test-headers.edit',
            'en_display_name' => 'Edit Qc Test',
            'ar_display_name' => 'تعديل اختبار مراقبة الجودة',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);
        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'qc-test-headers.delete',
            'en_display_name' => 'Delete Qc Test',
            'ar_display_name' => 'حذف اختبار مراقبة الجودة',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);


        $subMenu = SubMenu::where('code', 13)->first();

        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'transports.index',
            'en_display_name' => 'List Truck Arrival',
            'ar_display_name' => 'عرض وصول الشاحنات',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);
        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'transports.create',
            'en_display_name' => 'Create Truck Arrival',
            'ar_display_name' => 'إضافة وصول شاحنه',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);
        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'transports.edit',
            'en_display_name' => 'Edit Truck Arrival',
            'ar_display_name' => 'تعديل وصول شاحنه',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);
        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'transports.delete',
            'en_display_name' => 'Delete Truck Arrival',
            'ar_display_name' => 'حذف وصول الشاحنه',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);
        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'transports.check_in',
            'en_display_name' => 'Check In Truck',
            'ar_display_name' => 'ادخال الشاحنه',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);
        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'transports.check_out',
            'en_display_name' => 'Check Out Truck',
            'ar_display_name' => 'اخراج الشاحنه',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);
        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'transports.cancel',
            'en_display_name' => 'Cancel Truck',
            'ar_display_name' => 'الغاء دخول الشاحنه',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);

        $subMenu = SubMenu::where('code', 14)->first();

        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'arrived-trucks.index',
            'en_display_name' => 'List Arrived Trucks',
            'ar_display_name' => 'عرض الشاحنات المنتظره',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);

        $subMenu = SubMenu::where('code', 15)->first();

        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'samples-test.index',
            'en_display_name' => 'List Sampled Tests',
            'ar_display_name' => 'عرض العينات المختبره',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);

        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'samples-test.create',
            'en_display_name' => 'Create Sampled Test',
            'ar_display_name' => 'وضع نتائج الأختبار',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);

        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'samples-test.edit',
            'en_display_name' => 'Create Sampled Retest',
            'ar_display_name' => 'وضع نتائج أعادة الأختبار',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);

        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'samples-test.acceptRejected',
            'en_display_name' => 'Accept rejected test',
            'ar_display_name' => 'صلاحية قبول المرفوضات',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);

        $subMenu = SubMenu::where('code', 16)->first();

        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'edit-queue.index',
            'en_display_name' => 'List Trucks Queue To Edit',
            'ar_display_name' => 'عرض طابور الشاحنات لتعديل ترتيبها',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);

        $subMenu = SubMenu::where('code', 17)->first();

        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'production-process.index',
            'en_display_name' => 'List Raw Process',
            'ar_display_name' => 'عرض شاحنات الخامات',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);

        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'startProcess',
            'en_display_name' => 'Can Start Process',
            'ar_display_name' => 'بدء عملية التفريغ',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);

        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'finishProcess',
            'en_display_name' => 'Can Finish Process',
            'ar_display_name' => 'انهاء عملية التفريغ',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);

        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'transferLine',
            'en_display_name' => 'Can Transfer Process',
            'ar_display_name' => 'تحويل السيارة لخط اخر',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);

        $subMenu = SubMenu::where('code', 18)->first();

        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'scrap-process.index',
            'en_display_name' => 'List Scrap Process',
            'ar_display_name' => 'عرض شاحنات المخلفات',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);

        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'scrapStartProcess',
            'en_display_name' => 'Can Start Process',
            'ar_display_name' => 'بدء عملية التحميل',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);

        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'scrapFinishProcess',
            'en_display_name' => 'Can Finish Process',
            'ar_display_name' => 'انهاء عملية التحميل',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);

        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'scrapTransferLine',
            'en_display_name' => 'Can Transfer Process',
            'ar_display_name' => 'تحويل السيارة لخط اخر',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);

        $subMenu = SubMenu::where('code', 21)->first();

        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'finish-process.index',
            'en_display_name' => 'List Finish Process',
            'ar_display_name' => 'عرض شاحنات المادة التامه',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);

        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'finishStartProcess',
            'en_display_name' => 'Can Start Process',
            'ar_display_name' => 'بدء عملية التحميل',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);

        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'finishFinishProcess',
            'en_display_name' => 'Can Finish Process',
            'ar_display_name' => 'انهاء عملية التحميل',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);

        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'finishTransferLine',
            'en_display_name' => 'Can Transfer Process',
            'ar_display_name' => 'تحويل السيارة لخط اخر',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);

        $subMenu = SubMenu::where('code', 19)->first();

        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'trucks-scale.index',
            'en_display_name' => 'Manual Scale',
            'ar_display_name' => 'الميزان',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);

        $subMenu = SubMenu::where('code', 20)->first();

        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'blocked-drivers.index',
            'en_display_name' => 'List Blocked Drivers',
            'ar_display_name' => 'عرض السائقين المحظورين',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);

        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'blocked-drivers.edit',
            'en_display_name' => 'Unblock Blocked Drivers',
            'ar_display_name' => 'الغاء حظر السائقين',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);

        $subMenu = SubMenu::where('code', 22)->first();

        Permission::create([
            'sub_menu_id' => $subMenu->id,
            'name' => 'truck-summary.index',
            'en_display_name' => 'Trucks Summary',
            'ar_display_name' => 'ملخص العمليات',
            'en_description' => NULL,
            'ar_description' => NULL,
        ]);
    }
}
