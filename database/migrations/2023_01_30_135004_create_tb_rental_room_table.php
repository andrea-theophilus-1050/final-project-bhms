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
        Schema::create('tb_rental_room', function (Blueprint $table) {
            $table->id('rental_room_id');
            $table->unsignedBigInteger('room_id');
            $table->unsignedBigInteger('tenant_id');
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->integer('status')->default(0);
            $table->foreign('room_id')->references('room_id')->on('tb_rooms');
            $table->foreign('tenant_id')->references('tenant_id')->on('tb_main_tenants');
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
        Schema::dropIfExists('tb_rental_room');
    }
};
