<?php

use Illuminate\Database\Seeder;

class MainMenusTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('main_menus')->delete();
        
        \DB::table('main_menus')->insert(array (
            0 => 
            array (
                'id' => 1,
                'en_name' => 'Dashboard',
                'ar_name' => 'لوحة التحكم',
                'class' => 'sidebar sidebar-dashboard',
                'href' => 'home',
                'sub_class' => 'iconsminds-shop-4',
                'data_link' => NULL,
                'created_at' => '2019-09-02 17:37:55',
                'updated_at' => '2019-09-02 17:37:56',
            ),
            1 => 
            array (
                'id' => 2,
                'en_name' => 'Master Data',
                'ar_name' => 'البيانات الاساسية',
                'class' => 'sidebar sidebar-master-data',
                'href' => '#masterData',
                'sub_class' => 'iconsminds-digital-drawing',
                'data_link' => 'masterData',
                'created_at' => '2019-09-02 17:37:55',
                'updated_at' => '2019-09-02 17:37:56',
            ),
        ));
        
        
    }
}