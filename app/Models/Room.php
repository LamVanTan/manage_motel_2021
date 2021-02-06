<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Models\OrderRoom;
class Room extends Model
{
    protected $table = 'Phong';
    protected $primaryKey = 'id_room';
    
    //model-eloquent-ORM
    public function images()
    {
        return $this->hasMany('App\Models\Images', 'id_room');
    }

    public function floor()
	{
	    return $this->belongsTo('App\Models\Floor', 'id_floor');
    }
    public function roomType()
	{
	    return $this->belongsTo('App\Models\RoomType', 'id_roomtype');
    }
    public function serviceRoom()
    {
        return $this->belongsToMany('App\Models\Service', 'ThietBi_Phong' , 'id_room', 'id_service');
    }
    public function orderRoom(){
        return $this->hasOne('App\Models\OrderRoom', 'id_room');
    }

    public function TaiKhoan(){
        return $this->belongsTo('App\User', 'id');  
    }

    //end model-ORM

    //admin-room-index
    public function getListRoom($idUser){
        return Room::where('MaTaiKhoan', $idUser)
        ->orderBy('id_room', 'desc')
        ->paginate(5);
    }

    //admin-room-add
    public function addItemRoom($data){
        return DB::table('Phong')->insertGetId($data);
    }

    //admin-room-getItemEdit
    public function getItemEditRoom($idRoom){
        //return DB::table('room')->where('id_room', $idRoom)->first();
        return Room::find($idRoom);
    }

    //admin-room-editRoom
    public function editItemRoom($data,$idRoom){
        return DB::table('Phong')->where('id_room', $idRoom)->update($data);
    }

    //admin-room-delete
    public function deleteItemRoom($idRoom){
        return DB::table('Phong')->where('id_room', $idRoom)->delete();
    }

    //kiem tra ben tầng
    public function checkOrder($idRoom,$idUser){
        return OrderRoom::where('id_room', $idRoom)
        ->where('MaTaiKhoan',$idUser)
        ->where('trangThaiDonThue', 1)
        ->first();
    }


    //public room index
    public function getListRoomsPin(){
         return Room::where('status_room', 1)
         ->where('condition_room', 0)
         ->where('pinRooms', 1)
         ->orderBy('ngayHetHanPin', 'desc')
         ->get();
    }

    public function getListRooms(){
        return Room::where('status_room', 1)
        ->where('condition_room', 0)
        ->where('pinRooms', 2)
        ->orderBy('ngayHetHanPin', 'desc')
        ->get();
   }
   //detail-room
   public function getListRoomUser($idRoom){
        return Room::where('status_room', 1)
        ->where('condition_room', 0)
        ->where('pinRooms', '<>', 0)
        ->where('id_room','<>', $idRoom)
        ->orderBy('ngayHetHanPin', 'desc')
        ->limit(3)
        ->get();
   }

   

    
}
