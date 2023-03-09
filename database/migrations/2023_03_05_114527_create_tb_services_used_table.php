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
        Schema::create('tb_services_used', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_id');
            $table->unsignedBigInteger('rental_room_id');
            $table->string('price_if_changed')->nullable();
            $table->foreign('service_id')->references('service_id')->on('tb_services')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('rental_room_id')->references('rental_room_id')->on('tb_rental_room')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('tb_services_used');
    }
};
