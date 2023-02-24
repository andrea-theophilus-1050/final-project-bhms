<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('tb_type_service')->insert([
            ['type_name' => 'Electricity'],
            ['type_name' => 'Water'],
            ['type_name' => 'Internet'],
            ['type_name' => 'Telephone'],
            ['type_name' => 'Gas'],
            ['type_name' => 'Cable TV'],
            ['type_name' => 'Mobile Phone'],
            ['type_name' => 'Other'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('tb_type_service')->truncate();
    }
};
