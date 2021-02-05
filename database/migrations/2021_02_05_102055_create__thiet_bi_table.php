<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThietBiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ThietBi', function (Blueprint $table) {
            $table->increments('id_service');
            $table->string('name_service');
            $table->integer('status_service');
            $table->integer('price_service');
            $table->integer('MaTaiKhoan')->unsigned();
            $table->foreign('MaTaiKhoan')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ThietBi');
    }
}
