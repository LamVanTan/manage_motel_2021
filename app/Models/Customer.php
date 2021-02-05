<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class Customer extends Model
{
    protected $table = 'KhachHang';
    protected $primaryKey = 'id_customer';


    public function orderRoomCustomer(){
        return $this->hasOne('App\Models\OrderRoom', 'id_customer');
    }
    public function imagesCustomer()
    {
        return $this->hasMany('App\Models\Images', 'id_customer');
    }

    ///admin-add-itemcustomer
    public function addItemCustomer($data){
        return DB::table('KhachHang')->insertGetId($data);
    }

    public function getList(){
        return Customer::all();
    }
}
