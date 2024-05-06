<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViewVApiRaw extends Migration
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
                        CREATE or Alter View v_api_raw      
                        As      
                        Select      
                            s.sap_code                                                      as VENDORKEY      
                           ,S.ar_name                                                       as VENDORNAME      
                           ,i.sap_code                                                      as MATERIALKEY      
                           ,i.ar_name                                                       as MATERIALNAME      
                           ,round(tl.weight_in/1000,2)                                      as WEIGHT1      
                           ,format(tl.weight_in_date , 'yyyy-MM-d')                         as DATE1      
                           ,format(tl.weight_in_date , 'HH:mm:ss')                          as TIME1      
                           ,round(tl.weight_out/1000,2)                                     as WEIGHT2      
                           ,format(tl.weight_out_date , 'yyyy-MM-d')                        as DATE2      
                           ,format(tl.weight_out_date , 'HH:mm:ss')                         as TIME2      
                           ,round(tl.weight/1000,2)                                         as NETWEIGHT      
                           ,td.id                                                           as SERIAL      
                           ,cast(th.transport_number AS varchar)+'-'+CAST(td.id AS varchar) as TICKET      
                           ,td.truck_plates                                                 as TRUCNO      
                           ,tl.batch_number                                                 as CHARG      
                           ,td.discount                                                     as DISCOUNT 
                           ,ABS(ABS(Cast(td.in_weight/1000 as decimal(10,3))-Cast(td.out_weight/1000 as decimal(10,3)))-dbo.fn_closest_decimal_10(ABS(Cast(td.in_weight/1000 as decimal(10,3))-Cast(td.out_weight/1000 as decimal(10,3)))*cast((td.discount/100) as decimal(10,3))*1000)*0.001) as WEIGHT_DISC
                           ,Cast(th.arrival_time as date)                                   as post_date  
    from transports th left join transport_details td      
    on (th.id=td.transport_id)      
    left join transport_lines tl      
    on (td.id=tl.transport_detail_id)      
    left join item_types it      
    on (it.id=th.item_type_id)      
    left join item_group ig      
    on (ig.id=td.item_group_id)      
    left join items i      
    on (i.id=td.item_id)      
    left join suppliers s      
    on (s.id=th.supplier_id)      
    left join lines l      
    on (l.id=tl.line_id)      
    Where i.item_type_id = (select id from item_types where prefix = 'raw')      
    and  (tl.weight_in is not null and tl.weight_out is not null)     
    and   td.posted_at is null;  
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("drop view if exists v_api_raw");
    }
}
