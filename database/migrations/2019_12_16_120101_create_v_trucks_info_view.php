<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVTrucksInfoView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE VIEW v_tractors
                AS
                Select * from transport_details where is_trailer = 0
        ");

        DB::statement("
            CREATE VIEW v_trailers
            AS
            Select * from transport_details where is_trailer = 1
        ");

        DB::statement("
        CREATE VIEW v_trucks_info
        AS
        Select transport.id,
               transport.transport_number,
               transport.status,
               tractor.status as tractor_status,
               trailer.status as trailer_status,
               transport.driver_name,
               transport.driver_license,
               transport.driver_national_id,
               transport.driver_mobile,
               transport.supplier_id,
               transport.governorate_id,
               governorate.ar_name as gov_ar_name,
               governorate.en_name as gov_en_name,
               transport.city_id,
               city.ar_name as city_ar_name,
               city.en_name as city_en_name,
               transport.center_id,
               center.ar_name as center_ar_name,
               center.en_name as center_en_name,
               transport.truck_type_id,
               truck_type.ar_name as truck_type_ar_name,
               truck_type.en_name as truck_type_en_name,
               transport.truck_plates_tractor,
               transport.truck_plates_trailer,
               transport.item_type_id,
               item_type.ar_name as item_type_ar_name,
               item_type.en_name as item_type_en_name,
               item_type.prefix as item_type_prefix,
               transport.item_group_id,
               item_group.ar_name as item_group_ar_name,
               item_group.en_name as item_group_en_name,
               transport.theoretical_weight,
               transport.arrival_time,
               tractor.in_weight  tracktr_in_weight ,
               tractor.out_weight tracktr_out_weight ,
               trailer.in_weight   trailer_in_weight ,
               trailer.out_weight  trailer_out_weight ,
               transport.total_weight,
               transport.weight_difference,
               transport.created_at,
               transport.updated_at
        from transports transport left join governorates governorate
                                            on (governorate.id = transport.governorate_id)
                                  left join  cities city
                                             on (city.id = transport.city_id)
                                  left join centers center
                                            on (center.id = transport.center_id)
                                  left join trucks_types truck_type
                                            on (truck_type.id = transport.truck_type_id)
                                  left join item_types item_type
                                            on (item_type.id = transport.item_type_id)
                                  left join item_group
                                            on (item_group.id = transport.item_group_id)
                                  left join v_tractors tractor
                                            on (transport.id=tractor.transport_id)
                                  left join v_trailers trailer
                                            on (transport.id=trailer.transport_id)
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("
            DROP VIEW v_tractors;
            DROP VIEW v_trailers;
            DROP VIEW v_trucks_info;
        ");
    }
}
