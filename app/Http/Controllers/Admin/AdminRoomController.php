<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Floor;
use App\Models\RoomType;
use App\Models\Service;
use App\Models\ServiceRoom;
use App\Models\Images;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
use App\Models\BankUser;
class AdminRoomController extends Controller
{
    public function __construct(Floor $floor, RoomType $roomType, Service $service,
        ServiceRoom $serviceRoom,Room $room, Images $images, BankUser $bankUser){
        $this->floor = $floor;
        $this->roomType = $roomType;
        $this->service = $service;
        $this->serviceRoom = $serviceRoom;
        $this->room = $room;
        $this->images = $images;
        $this->bankUser = $bankUser;
    }
    public function index(){
        if(Auth::check()){
            $idUser = Auth::user()->id;
        }
        $listRoom = $this->room->getListRoom($idUser);
    	return view('admin.room.index',\compact('listRoom'));
    }

    public function add(){
        if(Auth::check()){
            $idUser = Auth::user()->id;
        }
        $listFloor = $this->floor->getListFloorRoom( $idUser);//tang
        $listRoomType = $this->roomType->getListRoomTypeRoom( $idUser);//loai phong
        $listService = $this->service->getListServiceRoom( $idUser);//dich vu
        return view('admin.room.add',\compact('listFloor','listRoomType','listService'));
    }

    public function postAdd(Request $request){
        $nameRoom = $request->name;
        $priceRoom = $request->price;
        $floorRoom = $request->floor;
        $roomType = $request->roomtype;
        $areaRoom = $request->area;
        $quantityPerson = $request->quantity;
        $statusRoom = $request->status;
        $detailRoom = $request->detail;
        $serviceRoom = $request->service;
        $soDien = $request->soDien;
        $soNuoc = $request->soNuoc;
        if(Auth::check()){
            $idUser = Auth::user()->id;
        }
        $data = [
            'name_room' => $nameRoom,
            'price_room' => $priceRoom,
            'area_room' =>  $areaRoom,
            'person_quantity'  =>   $quantityPerson,
            'id_floor' => $floorRoom,
            'id_roomtype' => $roomType,
            'status_room' => $statusRoom,
            'detail_room' => $detailRoom,
            'condition_room' => 0,
            'price_last' => $priceRoom,
            'chiSoDienBanDau' => $soDien,
            'chiSoNuocBanDau'  => $soNuoc,
            'MaTaiKhoan'    =>  $idUser,
            'PinRooms'  => 0
        ]; 
        // kiểm tra có files sẽ xử lý
		if($request->hasFile('photos')) {
			$allowedFileExtension=['jpg','png','jpeg'];
            $files = $request->file('photos');
            //dd($files);
            // flag xem có thực hiện lưu DB không. Mặc định là có
			$exe_flg = true;
			// kiểm tra tất cả các files xem có đuôi mở rộng đúng không
			foreach($files as $file) {
				$extension = $file->getClientOriginalExtension();            
				$check=in_array($extension,$allowedFileExtension);

				if(!$check) {
                    // nếu có file nào không đúng đuôi mở rộng thì đổi flag thành false
					$exe_flg = false;
					break;
				}
			}
			// nếu không có file nào vi phạm validate thì tiến hành lưu DB
			if($exe_flg) {
                // lưu product
				$itemRoom = $this->room->addItemRoom($data);
               // duyệt từng ảnh và thực hiện lưu
                if($serviceRoom){
                    foreach($serviceRoom as $key => $itemService){
                        $data = [
                            'id_service' => $itemService,
                            'id_room' =>$itemRoom,
                            'status_service_room' => 1
                        ];
                        $service_room = $this->serviceRoom->addServiceRoom($data);
                    }
                }
               $dem = 0;
				foreach ($files as $photo) {
                    $nameFile = $photo->getClientOriginalName();//lay ten anh
                    $explodeFile = explode('.',$nameFile);//tach chuoi anh
                    $ext = end($explodeFile);//lay duoc duoi .jpg
                    $filename = 'motel-'.time().$dem++.'.'.$ext;
                    $photo->move(base_path('storage/app/public/files/'),$filename);
                    $data = [
                                'name_images'=>$filename,
                                'id_room'=>$itemRoom
                            ];
					$imagesProducts = $this->images->addImagesRoom($data);
                }
                
				return redirect()->route('admin.room.index')->with('msg','Thêm Thành Công');
            } 
            else {
				return redirect()->route('admin.room.add')->with('msg','Sai định dạng file, File phải có đuôi JPG, PNG');
			}	
        }
    }

    public function edit($idRoom){
        if(Auth::check()){
            $idUser = Auth::user()->id;
        }
        $listFloor = $this->floor->getListFloorRoom( $idUser);//tang
        $listRoomType = $this->roomType->getListRoomTypeRoom( $idUser);//loai phong
        $listService = $this->service->getListServiceRoom( $idUser);//dich vu
        $itemEditRoom = $this->room->getItemEditRoom($idRoom);
    	return view('admin.room.edit',\compact('itemEditRoom','listFloor', 'listRoomType', 'listService'));
    }

    public function postEdit(Request $request, $idRoom){
        $nameRoom = $request->name;
        $priceRoom = $request->price;
        $floorRoom = $request->floor;
        $roomType = $request->roomtype;
        $areaRoom = $request->area;
        $quantityPerson = $request->quantity;
        $statusRoom = $request->status;
        $detailRoom = $request->detail;
        $serviceRoom = $request->service; 
        $soDien = $request->soDien;
        $soNuoc = $request->soNuoc;
        $data = [
            'name_room' => $nameRoom,
            'price_room' => $priceRoom,
            'area_room' =>  $areaRoom,
            'person_quantity'  =>   $quantityPerson,
            'id_floor' => $floorRoom,
            'id_roomtype' => $roomType,
            'status_room' => $statusRoom,
            'detail_room' => $detailRoom,
            'price_last' => $priceRoom,
            'chiSoDienBanDau' => $soDien,
            'chiSoNuocBanDau'  => $soNuoc,
        ];
        // kiểm tra có files sẽ xử lý
		if($request->hasFile('photos')) {
			$allowedFileExtension=['jpg','png','jpeg'];
            $files = $request->file('photos'); 
            // flag xem có thực hiện lưu DB không. Mặc định là có
			$exe_flg = true;
			// kiểm tra tất cả các files xem có đuôi mở rộng đúng không
			foreach($files as $file) {
				$extension = $file->getClientOriginalExtension();            
				$check=in_array($extension,$allowedFileExtension);
				if(!$check) {
                    // nếu có file nào không đúng đuôi mở rộng thì đổi flag thành false
					$exe_flg = false;
					break;
				}
			}
			// nếu không có file nào vi phạm validate thì tiến hành lưu DB
			if($exe_flg) {
                // update product
				$itemRoom = $this->room->editItemRoom($data,$idRoom);
                if($serviceRoom){
                    $deleteRoomService = $this->serviceRoom->deleteServiceRoom($idRoom);
                    if($deleteRoomService){
                        foreach($serviceRoom as $key => $itemService){
                            $data = [
                                'id_service' => $itemService,
                                'id_room' =>$idRoom,
                                'status_service_room' => 1
                            ];
                            $service_room = $this->serviceRoom->addServiceRoom($data);
                        }
                    }
                }
                // duyệt từng ảnh và thực hiện lưu
               $dem = 0;
				foreach ($files as $photo) {
                    $nameFile = $photo->getClientOriginalName();//lay ten anh
                    $explodeFile = explode('.',$nameFile);//tach chuoi anh
                    $ext = end($explodeFile);//lay duoc duoi .jpg
                    $filename = 'motel-'.time().$dem++.'.'.$ext;
                    $photo->move(base_path('storage/app/public/files/'),$filename);
                    $data = [
                                'name_images'=>$filename,
                                'id_room'=>$idRoom
                            ];
					$imagesProducts = $this->images->addImagesRoom($data);
				}
				return redirect()->route('admin.room.index')->with('msg','Cập nhật Thành Công');
            } 
            else {
				return redirect()->route('admin.room.edit')->with('msg','Sai định dạng file, File phải có đuôi JPG, PNG');
			}	
        }
        else{
            // lưu product
				$itemRoom = $this->room->editItemRoom($data,$idRoom);
                // duyệt từng ảnh và thực hiện lưu
                if($serviceRoom){
                    $deleteRoomService = $this->serviceRoom->deleteServiceRoom($idRoom);
                    if($deleteRoomService){
                        foreach($serviceRoom as $key => $itemService){
                            $data = [
                                'id_service' => $itemService,
                                'id_room' =>$idRoom,
                                'status_service_room' => 1
                            ];
                            $service_room = $this->serviceRoom->addServiceRoom($data);
                           
                        }
                    }
                }
            return redirect()->route('admin.room.index')->with('msg','Cập nhập Thành Công');
        }
    }

    public function delete($idRoom){
        //dd($idRoom);
        $deleteRoom = $this->room->deleteItemRoom($idRoom);
        if($deleteRoom){
            return redirect()->route('admin.room.index')->with('msg','Xoá Thành Công');
        }   
    }

    public function ajaxstatus(Request $request){
        $idRoom = $request->idRoom;
        $statusRoom = $request->statusRoom;
        if($statusRoom == 1)
        {
            $statusRoom = 0;        
        }
        else 
        {
            $statusRoom = 1;
        }        
        $data = [
            'status_room'  =>$statusRoom,
        ];     
        $result = $this->room->editItemRoom($data,$idRoom); 
        if($result){
            $status = $this->room->getItemEditRoom($idRoom);   
            $resultRoomStatus = $status->status_room;
            if($resultRoomStatus == 1){
                $statusRoom = 'Hiện';
                $online = "bg-success";
                $status_text = "btn btn-success btn-sm";
              }else{
                $statusRoom = 'Ẩn';
                $online = "bg-warning";
                $status_text = "btn btn-warning btn-sm";
            }    
            return  "<i class='{$online}'></i> 
            <label class='{$status_text}' onclick='statusRoom({$idRoom},{$resultRoomStatus})'>
              {$statusRoom}
            </label>";
        }
    }

    public function pinRooms(Request $request){
        $idRoom = $request->idRoom;
        $pinRooms = $request->pinRooms;
        $idUser = User::find(Auth::user()->id);
        if($idUser->bank == false){
            return $result = 1;
        }else{
            if($idUser->bank->soDuTaiKhoan <= 5000){
                return $result =  1;
            }else{
                $soDuTaiKhoan = ($idUser->bank->soDuTaiKhoan) - 5000;
                $data = [
                    'soDuTaiKhoan' => $soDuTaiKhoan
                ];
                $updateBankUser = $this->bankUser->updateBankUser($data,Auth::user()->id);
                //dd($updateBankUser);
                if($pinRooms == 0)
                {
                    $pinRooms = 1;        
                }
                $ngayHienTai = Carbon::now();
                $ngayHetHan = $ngayHienTai->addDay(3);
                $data = [
                    'PinRooms'  =>$pinRooms,
                    'ngayHetHanPin' => $ngayHetHan
                ];  
                $result = $this->room->editItemRoom($data,$idRoom); 
                if($result){
                    
                    $itemRoom = $this->room->getItemEditRoom($idRoom);   
                    $condition_room = $itemRoom->condition_room;
                    $pinRooms = $itemRoom->PinRooms;
                    if($pinRooms == 0){
                        $pinRoom = "Đưa top";
                        $pin = "btn btn-danger btn-sm";
                    }else{
                        $pinRoom = "Đã pin";
                        $pin = "btn btn-success btn-sm";
                    } 
                }
                if($pinRooms == 0 && $condition_room == 0 ){
                    $result = "<label class='{$pin}' onclick='statusPin({$idRoom},{$pinRooms})' >{$pinRoom}</label>";
                }else{
                    $result = "<label class='{$pin}' >{$pinRoom}</label>";
                }
                return $result;
            }
        }
    }
 
}
