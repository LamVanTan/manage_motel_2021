<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class Floor extends Model
{
    protected $table = 'Tang';
    protected $primaryKey = 'id_floor';

    //admin-ORM-floor_room
    public function floor_room()
    {
        return $this->hasMany('App\Models\Room', 'id_floor');
    }
    
    //admin-floor-index
    public function getListFloor($idUser){
        return DB::table('Tang')->where('MaTaiKhoan', $idUser)
        ->orderBy('id_floor','desc')->paginate(10);
    }
    //admin-floor-add
    public function addItemFloor($data){
        return DB::table('Tang')->insert($data);
    }

    //admin-floor-getEdit
    public function getItemEditFloor($Id_floor){
        return DB::table('Tang')->where('id_floor',$Id_floor)->first();
    }

    //admin-floor-updateItem
    public function updateItemFloor($data, $Id_floor){
        return DB::table('Tang')->where('id_floor', $Id_floor)->update($data);
    }

    //admin-delete
    public function deleteItemFloor($Id_floor){
        return DB::table('Tang')->where('id_floor', $Id_floor)->delete();
    }

    //admin-update-status_floor
    public function updateStatusItem($data, $Id_floor){
        return DB::table('Tang')->where('id_floor', $Id_floor)->update($data);
    }

    //admin-getList-floor-room
    public function getListFloorRoom($idUser){
        return DB::table('Tang')
        ->where('MaTaiKhoan', $idUser)
        ->where('status_floor', 1)
        ->get();
    }
}
