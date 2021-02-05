<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThanhToanDienNuocTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ThanhToanDienNuoc', function (Blueprint $table) {
            $table->increments('idThanhToan');
            $table->integer('idThuePhong')->unsigned();
            $table->integer('soDienCu');
            $table->integer('soDienHienTai');
            $table->float('tongTienDien');
            $table->integer('soNuocCu');
            $table->integer('soNuocHienTai');
            $table->float('tongTienNuoc');
            $table->integer('idAdmin')->unsigned();
            $table->char('nguoiNhan',100);
            $table->integer('tinhTrang');
            $table->dateTimeTz('ngayThanhToan');
            $table->float('tongTienThanhToan');
            $table->foreign('idThuePhong')->references('id_order')->on('ThuePhong')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ThanhToanDienNuoc');
    }
}
