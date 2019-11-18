<?php

use Illuminate\Database\Seeder;

class LinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Production\Line::query()->truncate();

        $itemTypeId =   optional(\App\Models\Items\ItemType::query()->where('prefix' , 'raw')->first())->id;
        \App\Models\Production\Line::query()->create([
            'ar_name'       =>  'خط المواد الخام 1',
            'en_name'       =>  'Raw Line 1',
            'type'          =>  'ProdLine',
            'item_type_id'  =>  $itemTypeId,
            'is_active'     =>  true,
        ]);

        \App\Models\Production\Line::query()->create([
            'ar_name'       =>  'خط المواد الخام 2',
            'en_name'       =>  'Raw Line 2',
            'type'          =>  'ProdLine',
            'item_type_id'  =>  $itemTypeId,
            'is_active'     =>  true,
        ]);

        $itemTypeId =   optional(\App\Models\Items\ItemType::query()->where('prefix' , 'scrap')->first())->id;
        \App\Models\Production\Line::query()->create([
            'ar_name'       =>  'خط الاسكراب 1',
            'en_name'       =>  'Scrap Line 1',
            'type'          =>  'ScrapLine',
            'item_type_id'  =>  $itemTypeId,
            'is_active'     =>  true,
        ]);

        \App\Models\Production\Line::query()->create([
            'ar_name'       =>  'خط الاسكراب 2',
            'en_name'       =>  'Scrap Line 2',
            'type'          =>  'ScrapLine',
            'item_type_id'  =>  $itemTypeId,
            'is_active'     =>  true,
        ]);

        $itemTypeId =   optional(\App\Models\Items\ItemType::query()->where('prefix' , 'finish')->first())->id;
        \App\Models\Production\Line::query()->create([
            'ar_name'       =>  'خط المنتج النهائي 1',
            'en_name'       =>  'Finish Line 1',
            'type'          =>  'Doc',
            'item_type_id'  =>  $itemTypeId,
            'is_active'     =>  true,
        ]);

        \App\Models\Production\Line::query()->create([
            'ar_name'       =>  'خط المنتج النهائي 2',
            'en_name'       =>  'Finish Line 2',
            'type'          =>  'Doc',
            'item_type_id'  =>  $itemTypeId,
            'is_active'     =>  true,
        ]);
    }
}
