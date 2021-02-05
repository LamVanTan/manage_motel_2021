<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;
class AdminServiceController extends Controller
{
    public function __construct(Service $service){
        $this->service = $service;
    }
    public function index(){
        if(Auth::check()){
            $idUser = Auth::user()->id;
        }
        $listService = $this->service->getListService($idUser);
    	return view('admin.service.index',\compact('listService'));
    }

    public function add(){
    	return view('admin.service.add');
    }

    public function postAdd(Request $request){
     
        $nameService = $request->name_service;
        $priceService = $request->price;
        $statusService = $request->status;
        if(Auth::check()){
            $idUser = Auth::user()->id;
        }
        $data = [
            'name_service'  =>  $nameService,
            'price_service' =>  $priceService,
            'status_service'=>  $statusService,
            'MaTaiKhoan'    =>  $idUser,
        ];
        $addItemService = $this->service->addItemService($data);
        if($addItemService){
            return \redirect()->route('admin.service.index')->with('msg', 'Thêm thành công');
        }
    }

    public function edit($id_service){
        $getItemService = $this->service->getItemService($id_service);
    	return view('admin.service.edit',\compact('getItemService'));
    }

    public function postEdit(Request $request, $id_service){
        $nameService = $request->name_service;
        $priceService = $request->price;
        $statusService = $request->status;
        $data = [
            'name_service'  => $nameService,
            'price_service' => $priceService,
            'status_service'=> $statusService
        ];
        $editItemService = $this->service->editItemService($data, $id_service);
        if($editItemService){
            return \redirect()->route('admin.service.index')->with('msg', 'Cập nhật thành công ');
        }

    }

    public function delete($id_service){
        $deleteItemService = $this->service->deleteItemService($id_service);
        if($deleteItemService){
            return \redirect()->route('admin.service.index')->with('msg', 'Xoá thành công');
        }
    }

    public function ajaxstatus(Request $request){
        $id_Service = $request->id_service;
        $status_service = $request->status_service;
        
        if($status_service == 1)
        {
            $status_service = 0;
            
        }
        else 
        {
            $status_service = 1;
        }
        
        $data = [
            'status_service'  =>$status_service,
        ];
        
        $result = $this->service->updateStatusItem($data,$id_Service);
        
        if($result){
            $status = $this->service->getItemService($id_Service);
            
            $result_service_status = $status->status_service;

            
            if($result_service_status == 1){
                $status_service = 'Hiện';
                $online = "bg-success";
                $status_text = "btn btn-success btn-sm";
              }else{
                $status_service = 'Ẩn';
                $online = "bg-warning";
                $status_text = "btn btn-warning btn-sm";
            }
            
            return  "<i class='{$online}'></i> 
            <label class='{$status_text}' onclick='statusService({$id_Service},{$result_service_status})'>
              {$status_service}
            </label>";
        }
    }
}
