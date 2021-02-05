<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThanhToanPhongTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ThanhToanPhong', function (Blueprint $table) {
            $table->increments('idThanhToan');
            $table->integer('idThuePhong')->unsigned();
            $table->integer('idAdmin');
            $table->date('ngayThanhToan');
            $table->integer('tinhTrang');
            $table->float('soTienTra');
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
        Schema::dropIfExists('ThanhToanPhong');
    }
}
