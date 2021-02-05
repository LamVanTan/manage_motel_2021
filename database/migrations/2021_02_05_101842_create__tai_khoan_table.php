<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaiKhoanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TaiKhoan', function (Blueprint $table) {
            $table->increments('idAdmin');
            $table->integer('idUser')->unsigned();
            $table->string('tenDayDu');
            $table->char('SDT',11);
            $table->integer('gioiTinh');
            $table->string('diaChi');
            $table->foreign('idUser')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TaiKhoan');
    }
}
