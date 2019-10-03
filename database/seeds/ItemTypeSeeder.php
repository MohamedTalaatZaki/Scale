<?php

use App\Models\Items\ItemType;
use Illuminate\Database\Seeder;

class ItemTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ItemType::truncate();
        ItemType::create([
            'en_name'=>'Raw',
            'ar_name'=>'مواد خام',
            'prefix'=>'raw'
        ]);
        ItemType::create([
            'en_name'=>'Scrap',
            'ar_name'=>'مخلفات',
            'prefix'=>'scrap'
        ]);
        ItemType::create([
            'en_name'=>'Finish',
            'ar_name'=>'منتجات نهائية',
            'prefix'=>'finish'
        ]);
    }
}
