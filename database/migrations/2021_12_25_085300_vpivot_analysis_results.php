<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class VpivotAnalysisResults extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
                        Create or alter View v_sample_details_pivot
                        as
                        Select sample_test_header_id , [Brix] , [Ph] , [Acidity] , [Ratio] , [Mold less] , [Not Damaged] 
                        From
                        (
                        select 
                               sample_test_header_id
                              ,element_name
                              , case when element_type = 'range' then sampled_range
                                else sampled_expected_result
                                end result_value  
                        from samples_test_details
                        ) details
                        PIVOT  
                        (  
                            SUM(result_value) FOR element_name IN ([Brix] , [Ph] , [Acidity] , [Ratio] , [Mold less] , [Not Damaged])
                        ) AS pivot_sample_details  
            ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("drop view v_sample_details_pivot");
    }
}
