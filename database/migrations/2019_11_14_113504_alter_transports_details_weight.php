<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTransportsDetailsWeight extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transport_details', function (Blueprint $table) {
            $table->renameColumn('weight' , 'in_weight');
            $table->double('out_weight')->after('status');
        });

        Schema::table('transports', function (Blueprint $table) {
            $table->double('weight_difference')->after('total_weight')->nullable();
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
            $table->renameColumn( 'in_weight', 'weight');
            $table->dropColumn('out_weight');
        });

        Schema::table('transports', function (Blueprint $table) {
            $table->dropColumn('weight_difference');
        });
    }
}
