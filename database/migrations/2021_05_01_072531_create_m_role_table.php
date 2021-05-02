<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateMRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_role', function (Blueprint $table) {
            $table->id();
            $table->string('name',15);
        });
        DB::table('m_role')->insert([
            [
                'id' => 1,
                'name' => 'Administrator'
            ],
            [
                'id' => 2,
                'name' => 'Staff'
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_roles');
    }
}
