<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Floor;
use Illuminate\Support\Facades\Auth;
class AdminFloorController extends Controller
{
    public function __construct(Floor $floor){
		$this->floor = $floor;
		
    }
    public function index(){
        if(Auth::check()){
            $idUser = Auth::user()->id;
        }
        $listFloor = $this->floor->getListFloor($idUser);
    	return view('admin.floor.index', compact('listFloor'));
    }
    public function add(){
    	return view('admin.floor.add');
    }
    public function postAdd(Request $request ){
        $name_floor = $request->floor;
        $status_floor = $request->status;
        //dd($name_floor);
        if(Auth::check()){
            $idUser = Auth::user()->id;
        }
        $data = [
            'name_floor' => $name_floor,
            'status_floor' => $status_floor,
            'MaTaiKhoan'    => $idUser
        ];
        $result = $this->floor->addItemFloor($data);
        if($result){
            return \redirect()->route('admin.floor.index')->with('msg','Thêm mới thành công');
        }
    }
    public function edit($Id_floor){
        $itemFloor = $this->floor->getItemEditFloor($Id_floor);
    	return view('admin.floor.edit',\compact('itemFloor'));
    }
    public function postEdit(Request $request, $Id_floor){
        //dd($Id_floor);
        $data = [
            'name_floor'    =>  $request->floor,
            'status_floor'  =>  $request->status,
        ];
        $updateItem = $this->floor->updateItemFloor($data, $Id_floor);
        if($updateItem){
            return \redirect()->route('admin.floor.index')->with('msg', 'Cập nhật thành công');
        } 
    }
    public function delete($Id_floor){
        $deleteItem = $this->floor->deleteItemFloor($Id_floor);
        if($deleteItem){
            return \redirect()->route('admin.floor.index')->with('msg', 'Xoá thành công');
        }
    }
    //ajax-status-floor
    public function ajaxstatus(Request $request){
        $Id_floor = $request->Id_floor;
        $status_floor = $request->status_floor;
        if($status_floor == 1)
        {
            $status_floor = 0;
        }
        else 
        {
            $status_floor = 1;
        }
        $data = [
            'status_floor'  =>$status_floor,
        ];
        $result = $this->floor->updateStatusItem($data,$Id_floor);
        if($result){
            $Status = $this->floor->getItemEditFloor($Id_floor);
            $result_floor_status = $Status->status_floor;

            //dd($result_floor_status);
            if($result_floor_status == 1){
                $status_floor = "Hiện";
                $online = "bg-success";
                $status_text = "btn btn-success btn-sm";
              }else{
                $status_floor = 'Ẩn';  
                $online = "bg-warning";
                $status_text = "btn btn-warning btn-sm";
            }
            return "<i class='{$online}'></i> 
            <label class='{$status_text}' onclick='statusFloor({$Id_floor},{$result_floor_status})'>
              {$status_floor}
            </label>";
        }
    }

}
