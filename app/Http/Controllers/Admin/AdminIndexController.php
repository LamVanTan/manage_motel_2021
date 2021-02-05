<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Cookie;
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
use App\Models\PaymentRoom;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
Use App\User;
Use App\Models\BankUser;
use PDF;
use Carbon\Carbon;
class AdminIndexController extends Controller
{
    public function __construct(ServiceRoom $serviceRoom,Customer $customer, Images $images,
     Room $room, Service $service, OrderRoom $order, OrderRoomDetail $orderDetail, 
     BankUser $bank,PaymentRoom $paymentrooom,Payment $Payment){
        $this->serviceRoom = $serviceRoom;
        $this->customer = $customer;
        $this->images = $images;
        $this->room = $room;
        $this->service = $service;
        $this->order = $order;
        $this->orderDetail = $orderDetail;
        $this->bank = $bank;
        $this->paymentrooom = $paymentrooom;
        $this->Payment = $Payment;  
    }
    public function index(){
        if(Auth::check()){
            $idUser = Auth::user()->id;
        }
        $year = Carbon::now('Asia/Ho_Chi_Minh')->year;
        $listOrderRoom = $this->order->getListOrderRoom($idUser);
        $listFloor = Floor::where('MaTaiKhoan',$idUser)->where('status_floor', 1)->get();
        $revenue = array();
        for($month = 1; $month <= 12;$month++){
            $total_price_DN_ht = $this->Payment->total_price_DN_ht($idUser,$month,$year);
            if($total_price_DN_ht){
                $total_price_DN_ht = $total_price_DN_ht;
            }else{
                $total_price_DN_ht = 0;
            }
            $doanhThuThang_ht = $this->paymentrooom->doanhThuThang_ht($idUser,$month,$year);
            $doanhThuThang_ht = $doanhThuThang_ht + $total_price_DN_ht;
            $revenue[$month] = $doanhThuThang_ht;
        }
        $total = array();
        for($month = 1; $month <= 12;$month++){
            $totalOrder = $this->order->totalOrder($idUser,$month,$year);
            if($totalOrder){
                $totalOrder = $totalOrder;
            }else{
                $totalOrder = 0;
            }
            $total[$month] = $totalOrder;
        }
        return view('admin.index.index',\compact('listOrderRoom','listFloor','idUser','revenue', 'year','total'));
    }
    public function revenueAjax(Request $request){
        $year = $request->year;
        if(Auth::check()){
            $idUser = Auth::user()->id;
        }
        $revenue = array();
        for($month = 1; $month <= 12;$month++){
            $total_price_DN_ht = $this->Payment->total_price_DN_ht($idUser,$month,$year);
            if($total_price_DN_ht){
                $total_price_DN_ht = $total_price_DN_ht;
            }else{
                $total_price_DN_ht = 0;
            }
            $doanhThuThang_ht = $this->paymentrooom->doanhThuThang_ht($idUser,$month,$year);
            $doanhThuThang_ht = $doanhThuThang_ht + $total_price_DN_ht;
            $revenue[$month] = $doanhThuThang_ht;
        }
        return view('admin.index.revenue',\compact('revenue','year'));
    }
    public function yearOrderAjax(Request $request){
        $year = $request->year;
        if(Auth::check()){
            $idUser = Auth::user()->id;
        }
        $total = array();
        for($month = 1; $month <= 12;$month++){
            $totalOrder = $this->order->totalOrder($idUser,$month,$year);
            if($totalOrder){
                $totalOrder = $totalOrder;
            }else{
                $totalOrder = 0;
            }
            $total[$month] = $totalOrder;
        }
        
        return view('admin.index.totalOrder',\compact('total','year'));
        
    }
    public function ajaxRentalForm(Request $request){
         $idRoom = $request->idRoom;
         $priceRoom  =  $this->room->getItemEditRoom($idRoom);
         $timeOrderRoom = $request->rentalForm;
         if($timeOrderRoom > 0){
             $totalPrice =  ($priceRoom->price_last) * $timeOrderRoom;
             return \number_format($totalPrice,0,',','.').' VND';
         }
    }
    public function serviceUpdateAjax(Request $request){
        $idRoom = $request->idRoom;
        $price_room = $request->price_room;
        $serviceRoom = $request->service;
        //dd($serviceRoom);
        
        $listItem = array();
        if($serviceRoom){
            $listItemService = $this->serviceRoom->selectService($idRoom);
            
            $listItem= array();
            foreach($listItemService as  $itemService) {  
               $listItem[] = $itemService->id_service;
            }
            //dd($listItem);

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
            //dd($serviceAdd);

            $deleteRoomService = $this->serviceRoom->deleteServiceRoom($idRoom);
            if($deleteRoomService){
                foreach($serviceRoom as $key => $roomService){
                    $data = [
                        'id_service' => $roomService,
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
            
            $totalPrice = $price_room;
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
                    $arr = $arr.$value[0].', ';
                    $totalPrice = $totalPrice ; 
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
    public function addCheckRoom(Request $request){
        $request = $request->all();
        $idRoom = $request['idRoom'];
        $fullName = $request['fullname'];
        $phone = $request['phone'];
        $address = $request['address'].', '.$request['ward'].', '.$request['district'].', '.$request['city'];
        $birthday = $request['birthday'];
        $gender = $request['gender'];
        $identity = $request['identity'];
        $timeOrderRoom = $request['status']; 
        $priceRoom = $request['total'];
        $priceRoom = (int) explodeString($priceRoom);
        $deposits_room = $request['deposits'];
        $deposits_room = (int) explodeString($deposits_room);
        $priceLast = $request['moneyLast'];
        $priceLast = (int) explodeString($priceLast);
        $email = $request['email'];
        $ngayCap = $request['ngayCap'];
        $noiCap = $request['noiCap'];
        if(Auth::check()){
            $idUser = Auth::user()->id; 
        }
        $priceRoomDiscount = ($priceRoom/$timeOrderRoom) * 0.2;
        $taiKhoan = User::find($idUser);
        if($taiKhoan->bank == false){
            return \redirect()->back()->with('warning', 'Số dư tài khoản của bạn không đủ để thực hiện chức năng này. Mức phí phải trả cho chức năng này là 20% giá phòng của tháng đầu tiên!');
        }else{
            if($taiKhoan->bank->soDuTaiKhoan <= $priceRoomDiscount){
                return \redirect()->back()->with('warning', 'Số dư tài khoản của bạn không đủ để thực hiện chức năng này. Mức phí phải trả cho chức năng này là 20% giá phòng của tháng đầu tiên!');
            }else{
                $soDuTaiKhoan = ($taiKhoan->bank->soDuTaiKhoan) - $priceRoomDiscount;
                $data = [
                    'soDuTaiKhoan' => $soDuTaiKhoan
                ];
                $updateBankUser =  $this->bank->updateBankUser($data,$idUser);
                if($updateBankUser){
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
                        'MaTaiKhoan' => $idUser
                    ];
                    //dd($data);
                    $itemCustomer = $this->customer->addItemCustomer($data);
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
                    $dateStart = Carbon::now('Asia/Ho_Chi_Minh');
                    $dateEnd = Carbon::now('Asia/Ho_Chi_Minh')->addMonths($timeOrderRoom);
                    $dataOrder = [
                        'date_start'    => $dateStart,
                        'date_end'      => $dateEnd,
                        'id_room'       => $idRoom,
                        'id_customer'   => $itemCustomer,
                        'price_room'    => $priceRoom,
                        'deposits'      => $deposits_room,
                        'money_last'    => $priceLast,
                        'trangThaiDonThue' => 1,
                        'MaTaiKhoan'   => $idUser

                    ];
                    $addItemOrder = $this->order->addItemOrder($dataOrder);
                    if($addItemOrder){
                        $getItemRoom = $this->room->getItemEditRoom($idRoom);
                        foreach($getItemRoom->serviceRoom as $item) {
                            $dataOrderDetail = [
                                'id_order' => $addItemOrder,
                                'id_service'  => $item->id_service
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
        }
    }
    // public function pdf(){
    //     $data = ['name' => 'tienduong'];	
    // 	$pdf = PDF::loadView('invoice',  compact('data'));
    // 		return $pdf->download('invoice.pdf');
    // }
    
}
