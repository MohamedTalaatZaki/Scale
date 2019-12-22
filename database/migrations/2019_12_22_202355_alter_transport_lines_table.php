<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTransportLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transport_lines', function (Blueprint $table) {
            $table->double('weight_in')->nullable();
            $table->dateTime('weight_in_date')->nullable();
            $table->double('weight_out')->nullable();
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
        Schema::table('transport_lines', function (Blueprint $table) {
            $table->dropColumn('weight_in');
            $table->dropColumn('weight_in_date');
            $table->dropColumn('weight_out');
            $table->dropColumn('weight_out_date');
        });
    }
}
