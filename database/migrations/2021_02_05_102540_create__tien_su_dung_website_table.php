<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTienSuDungWebsiteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TienSuDungWebsite', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('soDuTaiKhoan');
            $table->dateTimeTz('ngayNap');
            $table->integer('id_user')->unsigned();
            $table->float('soTienNap');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TienSuDungWebsite');
    }
}
