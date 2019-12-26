<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJsonResultView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();
        DB::statement("
                    Create View v_json_result 
                    As
                    Select 
                        id ,
                        '{'    
                        +'\"trans\":'+'\"'+transport_number+'\"'    
                        +',\"serial\":'+'\"'+cast(transport_detail as varchar(50))+'\"'    
                        +',\"driver\":'+'\"'+driver_name+'\"'    
                        +',\"plates\":'+'\"'+truck_plates+'\"'    
                        +',\"type\":'+'\"'+truck_type+'\"'    
                        +',\"item\":'+'\"'+item_name+'\"'    
                        +',\"disc\":'+'\"'+cast(disc as varchar(50))+'%\"'    
                        +',\"iw\":'+'\"'+cast(in_w as varchar(50))+'\"'    
                        +',\"ow\":'+'\"'+cast(out_w as varchar(50))+'\"'    
                        +'}' as json_result 
            from (
                  select t.id     
                        ,td.id transport_detail    
                        ,t.transport_number    
                        ,[dbo].[fn_string_To_BASE64](isnull(t.driver_name,'NA')) driver_name
                        ,isnull(t.driver_mobile,'NA')   driver_mobile 
                        ,t.driver_national_id    
                        ,td.truck_plates    
                        ,Case When is_trailer = 1 then 'trailer'    
                              when is_trailer = 0 then 'truck'    
                        End truck_type        
                        ,[dbo].[fn_string_To_BASE64](isnull(i.ar_name,'NA')) item_name   
                        ,td.discount   disc    
                        ,td.in_weight  in_w    
                        ,td.out_weight out_w    
                        ,Cast((td.in_weight-td.out_weight)*(td.discount/100) as decimal(10,3)) disc_w    
                        ,Cast((td.in_weight-td.out_weight)-((td.in_weight-td.out_weight)*(td.discount/100)) as decimal(10,3)) net_w  
                    from transports t left join transport_details td
                    on (t.id=td.transport_id)
                    left join items i 
                    on (i.id=td.item_id)
                    where t.departure_time is not null  
                ) o;
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("Drop view if exists v_accepted_results_details");
    }
}
