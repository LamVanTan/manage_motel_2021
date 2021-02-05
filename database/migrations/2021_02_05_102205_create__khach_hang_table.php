<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKhachHangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('KhachHang', function (Blueprint $table) {
            $table->increments('id_customer');
            $table->string('fullname');
            $table->string('address');
            $table->string('phone',11);
            $table->date('birthday');
            $table->integer('gender');
            $table->integer('identity_number');
            $table->date('ngayCap');
            $table->string('noiCap');
            $table->string('email')->unique()->nullable();
            $table->integer('Id_user')->unsigned()->nullable();
            $table->foreign('Id_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('KhachHang');
    }
}
