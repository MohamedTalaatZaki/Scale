<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViewTruckHistorySummary extends Migration
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
            Create view v_truck_history_summary
            As
            Select  th.id transport_id,
                    th.transport_number,
                    th.status transport_status,
                    th.driver_name,
                    th.driver_national_id,
                    th.driver_mobile,
                    Case When th.truck_plates_trailer is not null then th.truck_plates_tractor+'/'+th.truck_plates_trailer
                         Else th.truck_plates_tractor
                    End full_truck_plates,  
                    th.supplier_id,
                    s.ar_name supplier_name,
                    th.governorate_id,
                    g.ar_name governorate_name,
                    th.truck_type_id,
                    igt.ar_name as arrival_item_group,
                    tt.ar_name truck_desc,
                    td.id transport_detail_id,
                    cast(th.transport_number as varchar(50))+'-'+cast(td.id as varchar(50)) transport_detail_number,
                    td.truck_plates ,
                    Case When is_trailer = 1 then 'المقطورة'
                         when is_trailer = 0 then 'القاطرة/سيارة'
                    End truck_type,
                    td.item_group_id ,
                    ig.ar_name item_group_name,
                    td.item_id ,
                    i.ar_name item_name,
                    th.item_type_id ,
                    it.ar_name item_type_name,
                    Cast(td.in_weight/1000 as decimal(10,3)) in_weight,
                    Cast(td.out_weight/1000 as decimal(10,3)) out_weight,
                    td.discount,
                    ABS(Cast(td.in_weight/1000 as decimal(10,3))-Cast(td.out_weight/1000 as decimal(10,3))) Net_wieght_bf_disc,
                    ABS(Cast(td.in_weight/1000 as decimal(10,3))-Cast(td.out_weight/1000 as decimal(10,3)))*cast((td.discount/100) as decimal(10,3)) disc_weight,
                    ABS(ABS(Cast(td.in_weight/1000 as decimal(10,3))-Cast(td.out_weight/1000 as decimal(10,3)))-ABS(Cast(td.in_weight/1000 as decimal(10,3))-Cast(td.out_weight/1000 as decimal(10,3)))*cast((td.discount/100) as decimal(10,3))) Net_weight_af_disc,
                    th.arrival_time,
                    ts.sampling_time,
                    tr.result_time,
                    tc.test_count,
                    td.in_weight_time,
                    td.out_weight_time,
                    th.departure_time,
                    DATEDIFF(HOUR,th.arrival_time,ts.sampling_time)     waiting_until_sampling,
                    DATEDIFF(HOUR,ts.sampling_time,tr.result_time)      lab_process_time,
                    DATEDIFF(HOUR,tr.result_time,th.checkin_time)       waiting_until_process,
                    DATEDIFF(HOUR,td.in_weight_time,td.out_weight_time) production_process_time,
                    DATEDIFF(HOUR,th.arrival_time,td.out_weight_time)   truck_overall_time,
                    DATEDIFF(HOUR,td.out_weight_time,th.departure_time) departure_process_time,
                    DATEDIFF(HOUR,th.arrival_time,th.departure_time)    truck_total_time,
                    bd.block_reason
            from transports th left join transport_details td
            on (th.id=td.transport_id)
            left join (select transport_detail_id , count([transport_detail_id]) test_count
                        from   samples_test_header
                        group by transport_detail_id) tc
            on (tc.transport_detail_id=td.id)
            left join (select transport_detail_id, created_at sampling_time
                        from   samples_test_header
                        where  id in (select min(id) id 
                                        from	 samples_test_header 
                                        group by transport_detail_id)) ts
            on (ts.transport_detail_id=td.id)
            left join (select transport_detail_id, updated_at result_time
                        from   samples_test_header
                        where  id in (select max(id) id 
                                        from samples_test_header 
                                        group by transport_detail_id)) tr
            on (tr.transport_detail_id=td.id)
            left join item_types it
            on (it.id=th.item_type_id)
            left join item_group ig
            on (ig.id=td.item_group_id)
            left join item_group igt
            on(igt.id=th.item_group_id)
            left join items i
            on (i.id=td.item_id)
            left join suppliers s
            on (s.id=th.supplier_id)
            left join governorates g
            on (g.id = th.governorate_id)
            left join trucks_types tt
            on (tt.id=th.truck_type_id)
            left join blocked_drivers bd
            on (bd.national_id=th.driver_national_id and (cast(th.departure_time as date)=cast(bd.updated_at as date)))
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("drop view if exists v_truck_history_summary");
    }
}
