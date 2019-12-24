<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWeightTimeColumnsToTransportDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transport_details', function (Blueprint $table) {
            $table->dateTime('in_weight_time')->nullable();
            $table->dateTime('out_weight_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transport_details', function (Blueprint $table) {
            $table->dropColumn('in_weight_time');
            $table->dropColumn('out_weight_time');
        });
    }
}
