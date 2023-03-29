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
        Schema::create('tb_payment_vnpay', function (Blueprint $table) {
            $table->id('payment_id');
            $table->string('vnp_TmnCode');
            $table->string('vnp_HashSecret');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('tb_user')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('tb_payment_vnpay');
    }
};
