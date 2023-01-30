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
            $table->date('dob');
            $table->string('id_card');
            $table->string('phone_number');
            $table->string('email');
            $table->string('hometown');
            $table->string('preResidence');
            $table->string('status');
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
        Schema::dropIfExists('tb_main_tenants');
    }
};