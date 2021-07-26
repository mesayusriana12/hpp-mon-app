<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMSunDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_sun_data', function (Blueprint $table) {
            $table->id();
            $table->string('data_id',10);
            $table->double('voltage');
            $table->double('lux');
            $table->timestamps();
            $table->unsignedBigInteger('main_data_id');
            $table->foreign('main_data_id')->references('id')->on('m_main_data')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_sun_data');
    }
}
