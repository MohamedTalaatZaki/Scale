<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQcPivotResultRptTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qc_pivot_result_rpt', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('transport_header_id')->nullable();
            $table->unsignedBigInteger('transport_detail_id')->nullable();
            $table->unsignedBigInteger('sample_test_header_id')->nullable();
            $table->unsignedBigInteger('item_group_id')->nullable();
            $table->string('item_name')->nullable();
            $table->string('truck_plates')->nullable();
            $table->string('transport_no')->nullable();
            $table->string('result')->nullable();
            $table->datetime('test_datetime')->nullable();
            $table->date('test_date')->nullable();
            $table->time('test_time')->nullable();
            $table->string('brix')->nullable();
            $table->string('ph')->nullable();
            $table->string('acidity')->nullable();
            $table->string('ratio')->nullable();
            $table->string('mold')->nullable();
            $table->string('damaged')->nullable();
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
        Schema::dropIfExists('qc_pivot_result_rpt');
    }
}
