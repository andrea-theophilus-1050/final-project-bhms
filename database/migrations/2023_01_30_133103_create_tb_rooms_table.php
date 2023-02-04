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
            $table->integer('number_of_people');
            $table->string('status');
            $table->string('room_description');
            $table->unsignedBigInteger('area_id');
            $table->foreign('area_id')->references('area_id')->on('tb_area')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('tb_rooms');
    }
};
