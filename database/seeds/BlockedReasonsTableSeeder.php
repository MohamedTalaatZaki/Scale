<?php

use Illuminate\Database\Seeder;

class BlockedReasonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Security\BlockedReason::query()->truncate();

        \App\Models\Security\BlockedReason::query()->createMany([
            [
                'en_name'   =>  'Violation of security instructions',
                'ar_name'   =>  'مخالفة تعليمات الامن',
            ],[
                'en_name'   =>  'Smoking',
                'ar_name'   =>  'التدخين',
            ]
        ]);
    }
}
