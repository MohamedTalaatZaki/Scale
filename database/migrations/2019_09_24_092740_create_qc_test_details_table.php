<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQcTestDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qc_test_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('qc_test_header_id');
            $table->string('en_name');
            $table->string('ar_name');
            $table->string('test_type');
            $table->string('element_type');
            $table->integer('expected_result')->nullable();
            $table->double('min_range')->nullable();
            $table->double('max_range')->nullable();
            $table->string('element_unit')->nullable();
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
        Schema::dropIfExists('qc_test_details');
    }
}
