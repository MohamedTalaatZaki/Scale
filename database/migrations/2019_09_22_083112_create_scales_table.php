<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->unique();
            $table->double('limit')->default(100000.00);
            $table->double('scale_error')->default(0.0);
            $table->string('ip_address')->nullable();
            $table->string('brand');
            $table->string('model')->nullable();
            $table->string('com_port');
            $table->string('baud_rate');
            $table->string('byte_size');
            $table->string('stop_bits');
            $table->string('parity');
            $table->double('timeout')->default(0.0);
            $table->double('tolerance')->default(0);
            $table->integer('is_active')->default(0);
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
        Schema::dropIfExists('scales');
    }
}
