<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class ServiceRoom extends Model
{
    protected $table = 'ThietBi_Phong';
    protected $primaryKey = 'Id';

    //admin-room-service-add
    public function addServiceRoom($data){
        return DB::table('ThietBi_Phong')->insert($data);
    }
    //admin-room-service-edit
    public function updateServiceRoom($data, $idRoom){
        return DB::table('ThietBi_Phong')->where('id_room', $idRoom)->update($data);
    }
    public function deleteServiceRoom($idRoom){
        return DB::table('ThietBi_Phong')->where('id_room', $idRoom)->delete();
    }

    //admin-order-service-get
    public function selectService($idRoom){
        return DB::table('ThietBi_Phong')
        ->select('id_service')
        ->where('id_room', $idRoom)
        ->get();
    }

}
