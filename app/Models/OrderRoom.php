<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class OrderRoom extends Model
{
    protected $table = 'ThuePhong';
    protected $primaryKey = 'id_order';

    public function orderRoomDetail()
    {
        return $this->hasMany('App\Models\OrderRoomDetail', 'id_order');
    }

    public function room(){
         return $this->belongsTo('App\Models\Room', 'id_room');  
    }

    public function customer(){
        return $this->belongsTo('App\Models\Customer', 'id_customer');
    }
    public function Admin(){
        return $this->belongsTo('App\Models\Admin', 'idAdmin');
    }

    public function Payment(){
        return $this->hasMany('App\Models\Payment', 'idThuePhong');
    }

    public function PaymentRoom(){
        return $this->hasMany('App\Models\PaymentRoom', 'idThuePhong');
    }
        

    public function getListOrderRoom($idUser){
        return OrderRoom::where('MaTaiKhoan', $idUser)->where('trangThaiDonThue',1)->get();
    }
    
    //index order-admin
    public function getListOrder($idUser){
        return OrderRoom::where('MaTaiKhoan', $idUser)->orderBy('id_order', 'desc')->paginate(5);
    }
   
    public function addItemOrder($data){
        return DB::table('ThuePhong')->insert($data);
    }

    public function getIdOrder($idUser){
        return DB::table('ThuePhong')
        ->where('MaTaiKhoan', $idUser)
        ->orderBy('id_order')->first();
    }
    //admin order-edit-status
    public function editItemOrder($data,$idOrder){
        return DB::table('ThuePhong')->where('id_order', $idOrder)->update($data);
    }
    //admin order-edit-status-getitem
    public function getItemEditOrder($idOrder){
        return OrderRoom::find($idOrder);
    }
    
    //admin-month-get
    public function getItemMonth($month,$idOrder){
        return DB::table('ThuePhong')
            ->where('id_order', $idOrder)
            ->whereMonth('date_end',$month )
            ->first();
    }

    //admin-index-totalOrder-tK
    public function totalOrder($idUser,$month,$year){
        return DB::table('ThuePhong')->where('MaTaiKhoan', $idUser)
        ->whereYear('date_start', $year)->whereMonth('date_start', $month)
        ->where('trangThaiDonThue', 1)
        ->count('id_order');
    }

}
