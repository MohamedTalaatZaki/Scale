<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlockedDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blocked_drivers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('license')->nullable();
            $table->string('name')->nullable();
            $table->string('national_id')->unique();
            $table->string('mobile')->nullable();
            $table->integer('blocked_count')->default(0);
            $table->integer('is_blocked')->default(0);
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
        Schema::dropIfExists('blocked_drivers');
    }
}
