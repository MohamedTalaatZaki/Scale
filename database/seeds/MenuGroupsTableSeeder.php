<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuGroupsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        DB::table('menu_groups')->truncate();
        
        DB::table('menu_groups')->insert(array (
            0 => 
            array (
                'main_menu_id' => 2,
                'en_name' => 'Administration',
                'ar_name' => 'ادارة الصلاحيات والاعضاء',
                'aria_controls' => 'collapseAdministration',
                'order' => 1,
                'created_at' => '2019-09-02 17:40:06',
                'updated_at' => '2019-09-02 17:40:07',
            ),
            1 => 
            array (
                'main_menu_id' => 2,
                'en_name' => 'Governorates',
                'ar_name' => 'المحافظات',
                'aria_controls' => 'collapseGovernorates',
                'order' => 2,
                'created_at' => '2019-09-02 17:40:06',
                'updated_at' => '2019-09-02 17:40:07',
            ),
        ));
        
        
    }
}