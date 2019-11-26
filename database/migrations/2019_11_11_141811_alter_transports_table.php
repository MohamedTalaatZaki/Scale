<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTransportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transports', function (Blueprint $table) {
            $table->double('total_weight')->default(0)->after('arrival_time');
        });

        Schema::table('transport_details', function (Blueprint $table) {
            $table->double('weight')->default(0)->after('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transports', function (Blueprint $table) {
            $table->dropColumn('total_weight');
        });

        Schema::table('transport_details', function (Blueprint $table) {
            $table->dropColumn('weight');
        });
    }
}
