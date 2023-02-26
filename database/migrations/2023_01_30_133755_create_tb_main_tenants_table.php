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
        Schema::create('tb_main_tenants', function (Blueprint $table) {
            $table->id('tenant_id');
            $table->string('fullname');
            $table->string('gender');
            $table->string('dob');
            $table->string('id_card');
            $table->string('phone_number');
            $table->string('email');
            $table->string('hometown');
            $table->string('citizen_card_front_image')->nullable();
            $table->string('citizen_card_back_image')->nullable();
            $table->string('avatar')->nullable();
            $table->string('password')->nullable();
            $table->string('status')->default(0);
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('tb_user')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('tb_main_tenants');
    }
};
