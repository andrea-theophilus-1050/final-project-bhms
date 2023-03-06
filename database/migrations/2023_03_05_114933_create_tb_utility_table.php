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
            $table->unsignedBigInteger('date_id');
            $table->string('old_electricity_index');
            $table->string('new_electricity_index');
            $table->string('old_water_index');
            $table->string('new_water_index');
            // $table->string('date')->nullable();
            $table->timestamps();
            $table->foreign('date_id')->references('date_id')->on('tb_date')->onUpdate('cascade')->onDelete('cascade');
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
