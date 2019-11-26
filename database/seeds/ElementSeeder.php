<?php

use App\Models\QC\QcElement;
use Illuminate\Database\Seeder;

class ElementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $el = QcElement::where('en_name','Brix')->first();
       if(is_null($el)){
           QcElement::create([
               'en_name'=>'Brix',
               'ar_name'=>'Brix',
               'test_type'=>'chemical',
               'element_type'=>'range',
               'element_unit'=>'%'
           ]);
       }
        $el = QcElement::where('en_name','Acidity')->first();
        if(is_null($el)){
            QcElement::create([
                'en_name'=>'Acidity',
                'ar_name'=>'Acidity',
                'test_type'=>'chemical',
                'element_type'=>'range',
                'element_unit'=>'degree'
            ]);
        }
        $el = QcElement::where('en_name','Ph')->first();
        if(is_null($el)){
            QcElement::create([
                'en_name'=>'Ph',
                'ar_name'=>'Ph',
                'test_type'=>'chemical',
                'element_type'=>'range',
                'element_unit'=>'%'
            ]);
        }
        $el = QcElement::where('en_name','Ratio')->first();
        if(is_null($el)){
            QcElement::create([
                'en_name'=>'Ratio',
                'ar_name'=>'Ratio',
                'test_type'=>'chemical',
                'element_type'=>'range',
                'element_unit'=>'%'
            ]);
        }
        $el = QcElement::where('en_name','Color')->first();
        if(is_null($el)){
            QcElement::create([
                'en_name'=>'Color',
                'ar_name'=>'Color',
                'test_type'=>'visual',
                'element_type'=>'range',
                'element_unit'=>'%'
            ]);
        }
        $el = QcElement::where('en_name','Mold Free')->first();
        if(is_null($el)){
            QcElement::create([
                'en_name'=>'Brix',
                'ar_name'=>'Brix',
                'test_type'=>'visual',
                'element_type'=>'question',
                'element_unit'=>''
            ]);
        }
        $el = QcElement::where('en_name','Not Damaged')->first();
        if(is_null($el)){
            QcElement::create([
                'en_name'=>'Not Damaged',
                'ar_name'=>'Not Damaged',
                'test_type'=>'visual',
                'element_type'=>'question',
                'element_unit'=>''
            ]);
        }
    }
}
