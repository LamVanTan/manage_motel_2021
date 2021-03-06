<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHinhAnhTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('HinhAnh', function (Blueprint $table) {
            $table->increments('id_images');
            $table->string('name_images');
            $table->integer('id_room')->unsigned()->nullable();
            $table->integer('id_customer')->unsigned()->nullable();
            $table->integer('idAdmin')->unsigned()->nullable();
            $table->foreign('idAdmin')->references('idAdmin')->on('TaiKhoan')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('HinhAnh');
    }
}
