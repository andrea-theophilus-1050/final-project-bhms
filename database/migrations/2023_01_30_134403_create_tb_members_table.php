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
            $table->string('fullname');
            $table->string('gender');
            $table->string('dob');
            $table->string('id_card');
            $table->string('phone_number');
            $table->string('email');
            $table->string('hometown');
            $table->string('preResidence');
            $table->string('status');
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
