<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTansportLinesTableAddLineIsDelay extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transport_lines', function (Blueprint $table) {
            $table->integer('line_is_delay')->default(0);
            $table->longText('finish_comment')->nullable();
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
            $table->dropColumn('line_is_delay' , 'finish_comment');
        });
    }
}
