<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('main_menu_id');
            $table->string('en_name');
            $table->string('ar_name');
            $table->string('aria_controls');
            $table->integer('order')->nullable();
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
        Schema::dropIfExists('menu_groups');
    }
}
