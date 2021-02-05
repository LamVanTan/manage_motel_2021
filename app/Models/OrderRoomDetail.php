<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class OrderRoomDetail extends Model
{
    protected $table = 'ChiTietThuePhong';
    protected $primaryKey = 'id_order_detail';
    
    public function orderRoom()
	{
	    return $this->belongsTo('App\Models\OrderRoom', 'id_order');
    }

    public function addItemOrderDetail($data){
        return DB::table('ChiTietThuePhong')->insert($data);
    }
}
