<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RoomType;
use Illuminate\Support\Facades\Auth;
class AdminRoomTypeController extends Controller
{
    public function __construct(RoomType $roomtype){
        $this->roomtype = $roomtype;
    }
    public function index(){
        if(Auth::check()){
            $idUser = Auth::user()->id;
        }
        $listRoomType = $this->roomtype->getListRoomType($idUser);
        //dd($listRoomType);
    	return view('admin.roomtype.index', compact('listRoomType'));
    }

    public function add(){
    	return view('admin.roomtype.add');
    }
    public function postAdd(Request $request){
        $roomType = $request->roomtype;
        $status = $request->status;
        if(Auth::check()){
            $idUser = Auth::user()->id;
        }
        $data = [
            'name_roomtype' =>  $roomType,
            'status_roomtype' => $status,
            'MaTaiKhoan'    => $idUser
        ];
        $result = $this->roomtype->addItemRoomType($data);
        if($result){
            return \redirect()->route('admin.roomtype.index')->with('msg', 'Thêm thành công');
        }
    }

    public function edit($Id_roomtype){
        $itemRoomType = $this->roomtype->getItemEditRoomType($Id_roomtype);
        return view('admin.roomtype.edit', \compact('itemRoomType'));
    }

    public function postEdit(Request $request, $Id_roomtype){
        $roomType = $request->roomtype;
        $status = $request->status;
        $data = [
            'name_roomtype' =>$roomType,
            'status_roomtype'   => $status,
        ];
        $editItemRoomType = $this->roomtype->editItemRoomType($data, $Id_roomtype);
        if($editItemRoomType){
            return \redirect()->route('admin.roomtype.index')->with('msg', 'Cập nhật thành công');
        }
    }

    public function delete($Id_roomtype){
        $deleteItem = $this->roomtype->deleteItemRoomType($Id_roomtype);
        if($deleteItem){
            return \redirect()->route('admin.roomtype.index')->with('msg', 'Xoá thành công');
        }
    }

    public function ajaxstatus(Request $request){
        $id_RoomType = $request->id_RoomType;
        $status_RoomType = $request->status_RoomType;
        
        if($status_RoomType == 1)
        {
            $status_RoomType = 0;  
        }
        else 
        {
            $status_RoomType = 1;
        }
        //dd($status_RoomType);
        $data = [
            'status_roomtype'  =>$status_RoomType,
        ];
        //dd($data);
        $result = $this->roomtype->updateStatusItem($data,$id_RoomType);
        if($result){
            $status = $this->roomtype->getItemEditRoomType($id_RoomType);
            //dd($status);
            $result_roomtype_status = $status->status_roomtype;
            if($result_roomtype_status == 1){
                $status_roomtype = 'Hiện';
                $online = "bg-success";
                $status_text = "btn btn-success btn-sm";
              }else{
                $status_roomtype = 'Ẩn';
                $online = "bg-warning";
                $status_text = "btn btn-warning btn-sm";
            }
            //dd($status_roomtype);
            return  "<i class='{$online}'></i> 
            <label class='{$status_text}' onclick='statusRoomType({$id_RoomType},{$result_roomtype_status})'>
              {$status_roomtype}
            </label>";
        }
    }
}