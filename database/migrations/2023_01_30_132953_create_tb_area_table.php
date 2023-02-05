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
        Schema::create('tb_area', function (Blueprint $table) {
            $table->id('area_id');
            $table->string('area_name');
            $table->string('area_description')->nullable();
            $table->unsignedBigInteger('house_id');
            $table->foreign('house_id')->references('house_id')->on('tb_house')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('tb_area');
    }
};
