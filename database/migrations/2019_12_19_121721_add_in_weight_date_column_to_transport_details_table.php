<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddInWeightDateColumnToTransportDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transport_details', function (Blueprint $table) {
            $table->dateTime('weight_in_date')->nullable();
            $table->dateTime('weight_out_date')->nullable();
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
            $table->dropColumn('weight_in_date');
            $table->dropColumn('weight_out_date');
        });
    }
}
