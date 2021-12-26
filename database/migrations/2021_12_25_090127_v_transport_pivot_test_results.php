<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;


class VTransportPivotTestResults extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
                    Create or alter view v_pivot_test_transport
                    As
                    select t.id transport_header_id
                         , h.transport_detail_id
                         , t.item_group_id
                         , ig.en_name item_name
                         , td.truck_plates
                         , t.transport_number+'-'+cast(td.id as varchar(20)) transport_no
                         , h.result 
                         , h.created_at test_datetime
                         , h.id sample_test_header_id
                         , cast(h.created_at as date) test_date
                         , Cast(cast(h.created_at as time) as varchar(8)) test_time
                         , isnull(cast([Brix] as varchar(20))+' %',0) brix
                         , isnull(cast([Ph] as varchar(20))+' %','-') ph
                         , isnull(cast([Acidity]  as varchar(20))+' °','-') acidity 
                         , isnull(cast([Ratio] as varchar(20))+' %','-') ratio
                         , Case when [Mold less] = 1   then 'No' when [Mold less] = 0 then 'Yes' else '-' end mold
                         , Case when [Not Damaged] = 1 then 'No' when [Not Damaged] = 0 then 'Yes' else '-' end damaged
                    from samples_test_header h left join v_sample_details_pivot d
                    on (h.id=d.sample_test_header_id)
                    left join transport_details td on (td.id=h.transport_detail_id)
                    left join transports t on (t.id=td.transport_id)
                    left join item_group ig on (t.item_group_id=ig.id) 
                    where t.item_type_id = 1
                    ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         DB::statement("drop view v_pivot_test_transport");
    }
}
