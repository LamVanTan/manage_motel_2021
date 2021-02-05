<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThuePhongTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ThuePhong', function (Blueprint $table) {
            $table->increments('id_order');
            $table->date('date_start');
            $table->date('date_end');
            $table->integer('deposits');
            $table->integer('money_last');
            $table->integer('price_room');
            $table->integer('trangThaiDonThue');
            $table->integer('MaTaiKhoan')->unsigned();
            $table->integer('id_room')->unsigned();
            $table->integer('id_customer')->unsigned();
            $table->foreign('MaTaiKhoan')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_room')->references('id_room')->on('Phong')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_customer')->references('id_customer')->on('KhachHang')->onDelete('cascade')->onUpdate('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ThuePhong');
    }
}
