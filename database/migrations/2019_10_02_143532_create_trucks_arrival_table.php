<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrucksArrivalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trucks_arrival', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('transport_number');
            $table->string('status');
            $table->string('driver_name');
            $table->string('driver_license');
            $table->string('driver_national_id');
            $table->string('driver_mobile');
            $table->unsignedBigInteger('supplier_id');
            $table->unsignedBigInteger('governorate_id');
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('center_id')->nullable();
            $table->unsignedBigInteger('truck_type_id');
            $table->string('truck_plates_tractor');
            $table->string('truck_plates_trailer')->nullable();
            $table->string('item_type_id');
            $table->unsignedBigInteger('item_group_id')->nullable();
            $table->double('theoretical_weight')->nullable();
            $table->dateTime('arrival_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trucks_arrival');
    }
}
