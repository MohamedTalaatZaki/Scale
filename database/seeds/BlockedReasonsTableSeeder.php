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

        \App\Models\Security\BlockedReason::query()->insert(
            [
                'en_name'   =>  'Violation of security instructions',
                'ar_name'   =>  'مخالفة تعليمات الامن',
            ]
        );
        \App\Models\Security\BlockedReason::query()->insert(
            [
                'en_name'   =>  'Smoking',
                'ar_name'   =>  'التدخين',
            ]
        );
    }
}
