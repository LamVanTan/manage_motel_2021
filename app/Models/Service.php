<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class Service extends Model
{
    protected $table = 'ThietBi';
    protected $primaryKey = 'id_service';

    public function roomService()
    {
        return $this->belongsToMany('App\Models\Room', 'ThietBi_Phong' , 'id_room', 'id_service');
    }
    
    //admin-service-index
    public function getListService($idUser){
        return DB::table('ThietBi')->where('MaTaiKhoan', $idUser)
        ->orderBy('id_service', 'desc')->paginate(5);
    }
    //admin-service-add
    public function addItemService($data){
        return DB::table('ThietBi')->insert($data);
    }
    //admin-service-edit
    public function getItemService($id_service){
        return DB::table('ThietBi')->where('id_service', $id_service)->first();
    }
    //admin-service-postedit
    public function editItemService($data, $id_service){
        return DB::table('ThietBi')->where('id_service', $id_service)->update($data);
    }
    //admin-service-delete
    public function deleteItemService($id_service){
        return DB::table('ThietBi')->where('id_service', $id_service)->delete();
    }
    //admin-service-ajaxstatus
    public function updateStatusItem($data,$id_service){
        return DB::table('ThietBi')->where('id_service', $id_service)->update($data);
    }
    
    public function getListServiceRoom($idUser){
        return DB::table('ThietBi')
        ->where('MaTaiKhoan', $idUser)
        ->where('status_service', 1)
       ->get();
    }

    //admin-order-room-service
    public function getItemServiceOrder($idService){
        return DB::table('ThietBi')->where('id_service', $idService)->first();
    }
    
}
