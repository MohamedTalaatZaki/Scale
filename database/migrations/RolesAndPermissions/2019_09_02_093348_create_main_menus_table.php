<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMainMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main_menus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('en_name');
            $table->string('ar_name');
            $table->string('class')->nullable();
            $table->string('href');
            $table->string('sub_class')->nullable();
            $table->string('data_link')->nullable();
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
        Schema::dropIfExists('main_menus');
    }
}
