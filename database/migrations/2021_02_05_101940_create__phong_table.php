<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhongTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Phong', function (Blueprint $table) {
            $table->increments('id_room');
            $table->char('name_room',100);
            $table->float('price_room');
            $table->integer('area_room');
            $table->integer('person_quantity');
            $table->longText('detail_room');
            $table->integer('status_room');
            $table->integer('condition_room');
            $table->float('price_last');
            $table->integer('chiSoDienBanDau');
            $table->integer('chiSoNuocBanDau');
            $table->integer('pinRooms');
            $table->dateTimeTz('ngayHetHanPin');
            $table->integer('MaTaiKhoan')->unsigned();
            $table->integer('id_floor')->unsigned();
            $table->integer('id_roomtype')->unsigned();
            $table->foreign('id_floor')->references('id_floor')->on('Tang')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_roomtype')->references('id_roomtype')->on('LoaiPhong')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('Phong');
    }
}
