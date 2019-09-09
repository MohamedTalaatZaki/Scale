<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('roles')->delete();
        
        \DB::table('roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Admin',
                'display_name' => NULL,
                'description' => NULL,
                'is_active' => 1,
                'created_at' => '2019-09-05 09:52:29',
                'updated_at' => '2019-09-05 09:52:29',
            ),
        ));
        
        
    }
}