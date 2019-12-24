<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVAcceptedResultsDetails extends Migration
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
        Create view v_accepted_results_details
        as
        select sh.transport_detail_id,
               sh.created_at,
               th.supplier_id,
               th.item_group_id,
               th.item_type_id,
               it.prefix item_type_prefix ,
               td.truck_plates,
               tl.batch_number,
               sd.element_name,
               sampled_range,
               sd.element_unit
        from transport_lines tl left join transport_details td
                  on (tl.transport_detail_id=td.id)
        left join transports th
                  on (th.id=td.transport_id)
        left join samples_test_header sh
                  on (sh.transport_detail_id=td.id)
        left join samples_test_details sd
                  on (sd.sample_test_header_id=sh.id)
        left join item_types it
                  on (th.item_type_id=it.id)
        where sd.result = 'accepted'
        and sd.qc_test_detail_id in (select id
                                     from qc_test_details
                                     where qc_element_id in (select id
                                                                    from qc_elements
                                                                    where element_type = 'range'));
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("drop view if exists v_accepted_results_details");
    }
}
