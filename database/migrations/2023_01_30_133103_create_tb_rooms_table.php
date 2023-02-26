<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_rooms', function (Blueprint $table) {
            $table->id('room_id');
            $table->string('room_name');
            $table->string('price');
            $table->tinyInteger('status')->default('0'); // 0: available, 1: Already have a tenant, 2: Already have a deposit
            $table->string('room_description')->nullable();
            $table->unsignedBigInteger('house_id');
            $table->foreign('house_id')->references('house_id')->on('tb_house')->onUpdate('cascade')->onDelete('cascade');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_rooms');
    }
};
