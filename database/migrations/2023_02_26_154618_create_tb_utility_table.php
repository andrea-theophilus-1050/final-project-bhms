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
        Schema::create('tb_utility', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rental_room_id');
            $table->string('old_electricity_index');
            $table->string('new_electricity_index');
            $table->string('old_water_index');
            $table->string('new_water_index');
            $table->string('date')->nullable();
            $table->timestamps();
            $table->foreign('rental_room_id')->references('rental_room_id')->on('tb_rental_room')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_utility');
    }
};
