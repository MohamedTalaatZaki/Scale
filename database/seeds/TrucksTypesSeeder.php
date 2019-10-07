<?php

use Illuminate\Database\Seeder;

class TrucksTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trucks_types')->insert([
            'en_name'   =>  'Dump Truck',
            'ar_name'   =>  'Dump Truck',
        ]);
    }
}
