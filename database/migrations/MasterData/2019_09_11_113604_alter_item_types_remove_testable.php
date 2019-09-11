<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterItemTypesRemoveTestable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('item_types', function (Blueprint $table) {
            $table->dropColumn('testable');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('item_types', function (Blueprint $table) {
            $table->integer('testable')->default(0)->after('en_name');
        });
    }
}
