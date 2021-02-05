<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChiTietThuePhongTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ChiTietThuePhong', function (Blueprint $table) {
            $table->increments('id_order_detail');
            $table->integer('id_order')->unsigned();
            $table->integer('id_service')->unsigned();
            $table->foreign('id_order')->references('id_order')->on('ThuePhong')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_service')->references('id_service')->on('ThietBi')->onDelete('cascade')->onUpdate('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ChiTietThuePhong');
    }
}
