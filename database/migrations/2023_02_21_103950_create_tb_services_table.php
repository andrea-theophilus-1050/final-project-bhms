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
        Schema::create('tb_services', function (Blueprint $table) {
            $table->id('service_id');
            $table->string('service_name');
            $table->integer('price');
            $table->string('description');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('tb_user');
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
        Schema::dropIfExists('tb_services');
    }
};
