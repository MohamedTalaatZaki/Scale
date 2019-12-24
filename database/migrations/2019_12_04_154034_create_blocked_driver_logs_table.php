<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlockedDriverLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blocked_driver_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('blocked_driver_id');
            $table->unsignedBigInteger('blocked_by')->nullable();
            $table->unsignedBigInteger('blocked_reason_id')->nullable();
            $table->text('block_reason')->nullable();
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
        Schema::dropIfExists('blocked_driver_logs');
    }
}
