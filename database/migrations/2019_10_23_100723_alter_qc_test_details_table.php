<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterQcTestDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('qc_test_details', function (Blueprint $table) {
            $table->dropColumn('en_name');
            $table->dropColumn('ar_name');
            $table->dropColumn('test_type');
            $table->dropColumn('element_type');
            $table->dropColumn('element_unit');
            $table->unsignedBigInteger('qc_element_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('qc_test_details', function (Blueprint $table) {
            $table->dropColumn('qc_element_id');
            $table->string('en_name');
            $table->string('ar_name');
            $table->string('test_type');
            $table->string('element_type');
            $table->string('element_unit')->nullable();
        });
    }
}
