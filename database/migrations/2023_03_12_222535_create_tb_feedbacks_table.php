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
        Schema::create('tb_feedbacks', function (Blueprint $table) {
            $table->id('feedback_id');
            $table->string('content');
            $table->tinyInteger('status')->default(0); // 0: not read, 1: read
            $table->tinyInteger('anonymous')->default(1); // 1: anonymous, 0: not anonymous
            $table->unsignedBigInteger('tenant_id');
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
        Schema::dropIfExists('tb_feedbacks');
    }
};
