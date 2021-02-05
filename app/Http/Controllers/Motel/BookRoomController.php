<?php

namespace App\Http\Controllers\Motel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\ServiceRoom;
use App\Models\Customer;
use App\Models\Images;
use App\Models\Service;
use App\Models\OrderRoom;
use App\Models\Floor;
use App\Models\OrderRoomDetail;
class BookRoomController extends Controller
{
    public function __construct(ServiceRoom $serviceRoom,Customer $customer, Images $images, Room $room, Service $service, OrderRoom $order, OrderRoomDetail $orderDetail){
        $this->serviceRoom = $serviceRoom;
        $this->customer = $customer;
        $this->images = $images;
        $this->room = $room;
        $this->service = $service;
        $this->order = $order;
        $this->orderDetail = $orderDetail;
    }
    public function bookRoom($idRoom){
        $getItemRoom = $this->room->getItemEditRoom($idRoom);
        $listServiceShare = Service::where('status_service', 1)->get();
        return view('motel.room.book_room', \compact('getItemRoom','listServiceShare'));
    }

    public function serviceUpdateAjax(Request $request){
        $idRoom = $request->idRoom;
        $serviceRoom = $request->service;
        $price_room = $request->price_room;
        $listItem = array();
        if($serviceRoom){
            $listItemService = $this->serviceRoom->selectService($idRoom);
            $listItem= array();
            foreach($listItemService as  $itemService) {  
               $listItem[] = $itemService->id_service;
            }
            $array = array();
            $serviceAdd = array();
            $check = true;
            foreach($serviceRoom as $key => $itemService) {  
                if(in_array($itemService,$listItem)){
                    $array[] = $itemService;
                    
                }else{
                    $serviceAdd[] = $itemService;
                    $check = false;
                }
            } 
            
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
                
            }else{
                foreach($serviceRoom as $key => $itemService){
                    $data = [
                        'id_service' => $itemService,
                        'id_room' =>$idRoom,
                        'status_service_room' => 1
                    ];
                    $service_room = $this->serviceRoom->addServiceRoom($data);
                } 
            }
            $totalPrice = $price_room ;
            if($check == false){
                $getItemService = array();
                foreach($serviceAdd as $key => $item){
                    $getItemServiceOrder = $this->service->getItemServiceOrder($item);
                    if($getItemServiceOrder){
                        $getItemService[$getItemServiceOrder->id_service][] = $getItemServiceOrder->name_service;
                        $getItemService[$getItemServiceOrder->id_service][] = $getItemServiceOrder->price_service;
                    }
                }
                $arr = "";
                foreach($getItemService as $key => $value){  
                    $totalPrice = $totalPrice + $value[1];
                    $arr = $arr.$value[0].', ';
                } 
                
                echo "<script> alert('Bạn vừa thêm dịch vụ : {$arr}')</script>";
                
            }else{
                $getItemService = array();
                foreach($array as $key => $item){
                    $getItemServiceOrder = $this->service->getItemServiceOrder($item);
                    if($getItemServiceOrder){
                        $getItemService[$getItemServiceOrder->id_service][] = $getItemServiceOrder->name_service;
                        $getItemService[$getItemServiceOrder->id_service][] = $getItemServiceOrder->price_service;
                    }
                }
                $arr = "";
                foreach($getItemService as $key => $value){  
                    if($value[0] === "Điện" || $value[0] === 'Nước') {
                        $value[2] = 0;
                        $price_service = 0;
                    }else{
                        $price_service = $value[1];
                    }
                    $arr = $arr.$value[0].', ';
                    $totalPrice = $totalPrice + $price_service ; 
                } 
                echo "<script>alert('Dịch vụ đang có tại phòng là : {$arr}')</script>";
            }
        $data = [
            'price_last' => $totalPrice
        ];
            $updatePriceRoom = $this->room->editItemRoom($data,$idRoom);
            $total =number_format($totalPrice,0,',','.');
            return "Giá phòng : <b>{$total} VND</b> ";
            
            
        }

    }

    public function ajaxRentalForm(Request $request){
        $idRoom = $request->idRoom;
        $priceRoom  =  $this->room->getItemEditRoom($idRoom);
        $rentalForm = $request->rentalForm;
        if($rentalForm > 0 && $rentalForm == 1){
            $totalPrice =  (($priceRoom->price_last)/30) + 50000;
            return \number_format($totalPrice,0,',','.').' VND';
        }else if($rentalForm == 2){
           $totalPrice =  $priceRoom->price_last;
           return \number_format($totalPrice,0,',','.').' VND';
        }else{
            $totalPrice =  (($priceRoom->price_last*12) - (($priceRoom->price_last*12)*0.05) );
           return \number_format($totalPrice,0,',','.').' VND';
        }
   }


    public function postBookRoom(Request $request, $idRoom){
        $request = $request->all();
        return view('motel.room.success',\compact('request','idRoom'));
    }

    public function checkout(Request $request){
        $request = $request->all();
        //dd($request);
        $idRoom = $request['idRoom'];
        $service = $request['service'];
        $fullName = $request['fullname'];
        $phone = $request['phone'];
        $address = $request['address'];
        $birthday = $request['birthday'];
        $gender = $request['gender'];
        $identity = $request['soCMND'];
        $booking_form = $request['status'];
        $dateStart = $request['dateStart'];
        $dateEnd = $request['dateEnd'];
        $priceRoom = $request['total'];
        $priceRoom = (int) explodeString($priceRoom);
        $deposits_room = $request['deposits'];
        $deposits_room = (int) explodeString($deposits_room);
        $priceLast = $request['moneyLast'];
        $priceLast = (int) explodeString($priceLast);
        $email = $request['email'];
        $ngayCap = $request['ngayCap'];
        $noiCap = $request['noiCap'];

        $data = [
            'fullname' => $fullName,
            'address'    => $address,
            'phone'     =>  $phone,
            'birthday'  => $birthday,
            'gender'    =>  $gender,
            'identity_number' => $identity,
            'email'     => $email,
            'ngayCap'   =>  $ngayCap,
            'noiCap'    =>  $noiCap,
            
        ];
        $itemCustomer = $this->customer->addItemCustomer($data);
        //dd($itemCustomer);

        if(isset($request['fileCMND1'])  && isset($request['fileCMND2'])) {
            $allowedFileExtension=['jpg','png'];
            $fileCMND1 = $request['fileCMND1'];
            $fileCMND2 = $request['fileCMND2'];
            $extension1 = $fileCMND1->getClientOriginalExtension(); 
            $extension2 = $fileCMND2->getClientOriginalExtension();    
                
            $check1 =in_array($extension1,$allowedFileExtension);
            $check2 =in_array($extension2,$allowedFileExtension);
            $exe_flg = true;
            if(!$check1 && !$check2) {
                // nếu có file nào không đúng đuôi mở rộng thì đổi flag thành false
                $exe_flg = false; 
            }
            // nếu không có file nào vi phạm validate thì tiến hành lưu DB
			if($exe_flg) {
                $files = array($fileCMND1,$fileCMND2);
               
                $dem = 0;
				foreach ($files as $photo) {
                    $nameFile = $photo->getClientOriginalName();//lay ten anh
                    $explodeFile = explode('.',$nameFile);//tach chuoi anh
                    $ext = end($explodeFile);//lay duoc duoi .jpg
                    $filename = 'motel-'.time().$dem++.'.'.$ext;
                    $photo->move(base_path('storage/app/public/filesCustomer/'),$filename);
                    $data = [
                                'name_images'=>$filename,
                                'id_customer'=>$itemCustomer
                            ];
					$imagesProducts = $this->images->addImagesRoom($data);
				}
				
            } 
            else {
				return redirect()->back()->with('msg','Sai định dạng file, File phải có đuôi JPG, PNG');
            }  		
        }
        $dataOrder = [
            'date_start'    => $dateStart,
            'date_end'      => $dateEnd,
            'id_room'       => $idRoom,
            'id_customer'   => $itemCustomer,
            'price_room'    => $priceRoom,
            'deposits'      => $deposits_room,
            'money_last'    => $priceLast,
            'booking_form'  => $booking_form,
            'trangThaiDonThue' => 0,
        ];
        $addItemOrder = $this->order->addItemOrder($dataOrder);
       

        if($addItemOrder){
            foreach($service as $key => $idService){
                $dataOrderDetail = [
                    'id_order' => $addItemOrder,
                    'id_service'  => $idService
                ];
                $addItemOrderDetail = $this->orderDetail->addItemOrderDetail($dataOrderDetail);
            }

            $data = [
                'condition_room' => 1
            ];
            $updateBooking = $this->room->editItemRoom($data, $idRoom);
            
        }
        return \redirect()->back()->with('messages', 'Đặt phòng thành công');

    }
}
