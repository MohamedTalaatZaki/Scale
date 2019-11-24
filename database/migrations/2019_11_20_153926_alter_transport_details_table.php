<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTransportDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transport_details', function (Blueprint $table) {
            $table->float('out_weight')->default(0)->change();
            $table->unsignedBigInteger('item_group_id')->nullable()->after('transport_id');
            $table->unsignedBigInteger('item_id')->nullable()->after('item_group_id');
            $table->double('discount')->default(0)->after('item_id');
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
            $table->dropColumn('item_group_id');
            $table->dropColumn('item_id');
            $table->dropColumn('discount');
        });
    }
}
