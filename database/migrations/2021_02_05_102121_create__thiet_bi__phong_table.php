<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThietBiPhongTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ThietBi_Phong', function (Blueprint $table) {
            $table->increments('Id');
            $table->integer('id_service')->unsigned();
            $table->integer('id_room')->unsigned();
            $table->integer('status_service_room');
            $table->foreign('id_room')->references('id_room')->on('Phong')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('ThietBi_Phong');
    }
}
