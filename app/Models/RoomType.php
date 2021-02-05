<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class RoomType extends Model
{
    protected $table = 'LoaiPhong';
    protected $primaryKey = 'id_roomtype';

    //admin-orm-roomtype-room
    public function room()
    {
        return $this->hasMany('App\Models\Room', 'id_roomtype');
    }
    //admin-roomtype-index
    public function getListRoomType($idUser){
        return DB::table('LoaiPhong')->where('MaTaiKhoan', $idUser)
        ->orderBy('id_roomtype', 'desc')->paginate(10);
    }

    //admin-roomtype-add
    public function addItemRoomType($data){
        return DB::table('LoaiPhong')->insert($data);
    }

    //admin-roomtype-edit
    public function getItemEditRoomType($Id_roomtype){
        return DB::table('LoaiPhong')->where('id_roomtype', $Id_roomtype)->first();
    }

    //admin-roomtype-postedit
    public function editItemRoomType($data, $Id_roomtype){
        return DB::table('LoaiPhong')->where('id_roomtype', $Id_roomtype)->update($data);
    }

    //admin-roomtype-delete
    public function deleteItemRoomType($Id_roomtype){
        return DB::table('LoaiPhong')->where('id_roomtype', $Id_roomtype)->delete();
    }

    //admin-roomtye-ajaxstatus
    public function updateStatusItem($data, $Id_roomtype){
        return DB::table('LoaiPhong')->where('id_roomtype', $Id_roomtype)->update($data);
    }

    //admin-roomtype-room
    public function getListRoomTypeRoom($idUser){
        return DB::table('LoaiPhong')
        ->where('MaTaiKhoan', $idUser)
        ->where('status_roomtype', 1)
        ->get();
    }
}
