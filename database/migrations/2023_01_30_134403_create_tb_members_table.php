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
        Schema::create('tb_members', function (Blueprint $table) {
            $table->id('member_id');
            $table->string('fullname')->nullable();
            $table->string('gender')->nullable();
            $table->string('dob')->nullable();
            $table->string('id_card')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->string('hometown')->nullable();
            $table->string('citizen_card_front_image')->nullable();
            $table->string('citizen_card_back_image')->nullable();
            $table->string('avatar')->nullable();
            $table->unsignedBigInteger('tenant_id');
            $table->foreign('tenant_id')->references('tenant_id')->on('tb_main_tenants')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('tb_members');
    }
};
