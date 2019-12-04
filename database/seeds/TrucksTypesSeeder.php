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
            'en_name'   =>  'Truck and Trailer',
            'ar_name'   =>  'تريلة و مقطورة',
        ]);

        DB::table('trucks_types')->insert([
            'en_name'   =>  'Truck',
            'ar_name'   =>  'تريلة مفردة',
        ]);

        DB::table('trucks_types')->insert([
            'en_name'   =>  'Jumbo Truck',
            'ar_name'   =>  'سيارة جامبو',
        ]);

        DB::table('trucks_types')->insert([
            'en_name'   =>  'Pickup Truck',
            'ar_name'   =>  'سيارة نصف نقل - دبابة',
        ]);

    }
}
