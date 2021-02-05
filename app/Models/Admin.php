<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class Admin extends Model
{
    protected $table = 'TaiKhoan';
    protected $primaryKey = 'idAdmin';


    public function orderRoomAdmin(){
        return $this->hasOne('App\Models\OrderRoom', 'idAdmin');
    }
    public function userAdmin(){
        return $this->belongsTo('App\User', 'id');  
    }
   public function addTaiKhoan($data){
        return DB::table('TaiKhoan')->insert($data);
   }
}
