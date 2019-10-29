<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSamplesTestDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('samples_test_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('sample_test_header_id');
            $table->unsignedBigInteger('qc_test_detail_id');
            $table->string('element_name')->nullable();
            $table->string('test_type')->nullable();
            $table->string('element_type')->nullable();
            $table->integer('expected_result')->nullable();
            $table->double('min_range')->nullable();
            $table->double('max_range')->nullable();
            $table->double('element_unit')->nullable();
            $table->integer('sampled_expected_result')->nullable();
            $table->double('sampled_range')->nullable();
            $table->string('result')->nullable();
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
        Schema::dropIfExists('samples_test_details');
    }
}
