<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OrderRoom;
use App\Models\Service;
use App\Models\Room;
use App\Models\Payment;
use App\Models\Floor;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\User;
use App\Models\PaymentRoom;
use Carbon\Carbon;

use PDF;
class AdminOrderRoomController extends Controller
{
    public function __construct(OrderRoom $order, Service $service, Room $room, Payment $payment, PaymentRoom $paymentroom){
        $this->order = $order;
        $this->service = $service;
        $this->room = $room;
        $this->payment = $payment;
        $this->paymentroom = $paymentroom;
    }
    public function index(){
        if(Auth::check()){
            $idUser = Auth::user()->id;
        }
        $listOrderRoom = $this->order->getListOrder($idUser);
        $listService = $this->service->getListServiceRoom($idUser);
        return view('admin.order.index',\compact('listOrderRoom','listService'));
    }
    public function searchDate(Request $request){
        $date_start = $request->date_start;
        $date_end   =  $request->date_end;
        if(Auth::check()){
            $idUser = Auth::user()->id;
        }
        $listOrderRoom = OrderRoom::whereBetween('date_start', [$date_start,$date_end])->get();
        $listService = $this->service->getListServiceRoom($idUser);
        //dd($listService);
        return view('admin.order.tableOrder',\compact('listOrderRoom','listService'));
    }
    public function ajaxstatus(Request $request){
        $idOrder = $request->idOrder;
        $status = $request->status;
        if($status == 0)
        {
            $status = 1;        
        }
              
        $data = [
            'trangThaiDonThue' =>$status,
        ];     
        $result = $this->order->editItemOrder($data,$idOrder); 
        if($result){
            $status = $this->order->getItemEditOrder($idOrder);   
            $resultStatus = $status->trangThaiDonThue;
            if($resultStatus == 0){
                $status_text = "btn btn-success btn-sm";
                $tinhTrang = "Xác nhận";
              }else{
                $status_text = "btn btn-warning btn-sm";
                $tinhTrang = "Đang thuê";
            } 
            if($resultStatus == 0) {
                $result =  "<label class='{$status_text}' onclick='changeStatus({$idOrder},{$tinhTrangDonThue})'>     
                           {$tinhTrang}
                    </label>";
            }else{
                $result = "<label class='{$status_text}'  onclick='message()'>{$tinhTrang}</label>";
            }
            return $result ;
            
        }

       
    }
    //lập hoá đơn tiền điện nước
    public function payment(Request $request){
        $idOrder = $request->idOrder;
        $getItemRoomService = $this->order->getItemEditOrder($idOrder);
        foreach($getItemRoomService->room->serviceRoom as $value){  
            if($value->name_service === "Điện" ) {
                $giaDien = $value->price_service; 
            }elseif($value->name_service === "Nước"){
                $giaNuoc = $value->price_service;
            }
        } 
        $soDienBanDau = $request->soDienBanDau;
        $soDienHienTai = $request->soDienHienTai;
        $soDienCuoi = $request->soDienCuoi;
        $tongTienDien = $soDienCuoi * $giaDien;

        $soNuocBanDau = $request->soNuocBanDau;
        $soNuocHienTai = $request->soNuocHienTai;
        $soNuocCuoi = $request->soNuocCuoi;
        $tongTienNuoc = $soNuocCuoi * $giaNuoc;
        if(Auth::check()){
            $idUser = Auth::user()->id;
            $TaiKhoan = User::find(Auth::user()->id);
            $idQuanLy = $TaiKhoan->admin->idAdmin; 
        }
        $nguoiNhan = "Nhân viên điện nước";
        $ngayThanhToan = Carbon::now();
        $tongTien = $tongTienDien + $tongTienNuoc;
        $data = [
            'idThuePhong' => $idOrder,
            'soDienCu' => $soDienBanDau,
            'soDienHienTai' => $soDienHienTai,
            'tongTienDien'  =>  $tongTienDien,
            'soNuocCu'  =>  $soNuocBanDau,
            'soNuocHienTai' => $soNuocHienTai,
            'tongTienNuoc'=>    $tongTienNuoc,
            'idAdmin'   =>  $idUser,
            'nguoiNhan' => $nguoiNhan,
            'tinhTrang' => 0,
            'ngayThanhToan' => $ngayThanhToan,
            'tongTienThanhToan' => $tongTien,
        ];
        $idRoom = $getItemRoomService->room->id_room;
        //dd($idRoom);
        $addItemPay = $this->payment->addItemPay($data);
        if($addItemPay){
            $data = [
                'chiSoDienBanDau' => $soDienHienTai,
                'chiSoNuocBanDau' => $soNuocHienTai,
            ];
            $editItemRoom = $this->room->editItemRoom($data,$idRoom);
        }
        return \redirect()->back()->with('thanhToanTien', 'lập hoá đơn thanh toán tiền điện, nước thành công');      
    }
    public function thanhToanDienNuoc(Request $request){
        $idThanhToan = $request->idThanhToan;
        $data = [
            'tinhTrang' => 1
        ];
        $updatePayment = $this->payment->updatePayment($data,$idThanhToan);
        if($updatePayment){
            return "
            <input type='text' class='form-control form-control-sm' hidden value='{$idThanhToan}' name='idThanhToan' >
          <div class='row'>
            <div class='col-lg-12'>
              <div class='form-group'>
                <h4>Thanh toán tiền điện, nước thành công!</h4>
              </div>
            </div>
           <div class='col-lg-12'>
            <div class='form-group '>
                <button type='submit' class='btn btn-success btn-sm'>In Hoá Đơn</button>
            </div>
            </div> 
          </div>";
        }  
    }
    //in hoá đơn tiền điện nước
    public function printFast(Request $request){
        $idThanhToan = $request->idThanhToan;
        
        $getItemPayment = $this->payment->getItemPayment($idThanhToan);
        $getItemRoomService = $this->order->getItemEditOrder($getItemPayment->idThuePhong);
        foreach($getItemRoomService->room->serviceRoom as $value){  
            if($value->name_service === "Điện" ) {
                $giaDien = $value->price_service; 
            }elseif($value->name_service === "Nước"){
                $giaNuoc = $value->price_service;
            }
        } 
        //dd($getItemRoomService->room->floor->name);
        if(Auth::check()){
            $idAdmin = Auth::user()->id;
            $TaiKhoan = User::find(Auth::user()->id);
            $nameAdmin = $TaiKhoan->admin->tenDayDu;
            $diaChiAdmin = $TaiKhoan->admin->diaChi;   
        }
        $ngayThanhToan = Carbon::now();
        $ngayThanhToan = Carbon::parse($ngayThanhToan)->format('H:m:s d/m/Y');
        $nguoiNhan = "Nhân viên điện nước";
        $data = [
                'phong' => $getItemRoomService->room->name_room,
                'tang' =>$getItemRoomService->room->floor->name_floor,
                'fullName' => $nameAdmin,
                'diaChi' => $diaChiAdmin,
                'ngayThanhToan' =>$ngayThanhToan,
                'nguoiNhan' => $nguoiNhan,
                'soDienCu' => $getItemPayment->soDienCu,
                'soDienHienTai' => $getItemPayment->soDienHienTai,
                'soDienCuoi' => $getItemPayment->soDienHienTai - $getItemPayment->soDienCu,
                'tongTienDien'  =>  $getItemPayment->tongTienDien,
                'soNuocCu'  =>  $getItemPayment->soNuocCu,
                'soNuocHienTai' => $getItemPayment->soNuocHienTai,
                'soNuocCuoi' => $getItemPayment->soNuocHienTai - $getItemPayment->soNuocCu,
                'tongTienNuoc'=> $getItemPayment->tongTienNuoc,
                'tongTienThanhToan' => $getItemPayment->tongTienThanhToan,
                'giaDien' => $giaDien,
                'giaNuoc' => $giaNuoc,
        ];
            //dd($data);
            
            $pdf = PDF::loadView('admin/hoadon/hoadondiennuoc',compact('data'));
            return $pdf->download("hoadondiennuoc.pdf");
    }

    public function ajaxDate(Request $request){
        $month = $request->month;
        $idOrder = $request->idOrder;
        $getItemMonth = $this->order->getItemMonth($month,$idOrder);
        $idOrder = $getItemMonth->id_order;
        if($getItemMonth){
            $check = $this->payment->check($idOrder);
            if($check){
                return "<label class='form-control-label' style='font-size: 12px !important;'>Tình trạng</label>
                <input class='btn btn-success btn-sm ' value='Đã thanh toán'>";
            }else{
                return "<label class='form-control-label' style='font-size: 12px !important;'>Tình trạng</label>
                <input class='btn btn-warning btn-sm ' value='Chưa thanh toán'>";
            }
        }

    }
 

    //lập hoá đơn tính tiền phòng
    public function paymentRoom(Request $request){
        $idOrder = $request->idOrder;
        if(Auth::check()){
            $idAdmin = Auth::user()->id; 
            $TaiKhoan = User::find(Auth::user()->id);
            $idQuanLy = $TaiKhoan->admin->idAdmin;
        }
        

        $getPriceRoom = $this->order->getItemEditOrder($idOrder);
        
        if($getPriceRoom){
            $ngayThanhToan = Carbon::now('Asia/Ho_Chi_Minh');
            $soTienTra = $getPriceRoom->money_last;
            $data = [
                'idThuePhong' => $idOrder,
                'idAdmin'   =>  $idAdmin ,
                'ngayThanhToan' => $ngayThanhToan,
                'tinhTrang' => 0,
                'soTienTra' =>$soTienTra
            ];
            $addItemPaymentRoom = $this->paymentroom->addItemPaymentRoom($data);
            //dd($addItemPaymentRoom);
        }
        return \redirect()->back()->with('thanhToanTien', 'lập hoá đơn thanh toán tiền phòng thành công');

    }

    //thanh toán tiền phòng
    public function thanhToan(Request $request){
        $idThanhToan = $request->idThanhToan;
        $data = [
            'tinhTrang' => 1
        ];
        $updatePaymentRoom = $this->paymentroom->updatePaymentRoom($data, $idThanhToan);
        if($updatePaymentRoom){
            return "
            <input type='text' class='form-control form-control-sm' hidden value='{$idThanhToan}' name='idThanhToan' >
          <div class='row'>
            <div class='col-lg-12'>
              <div class='form-group'>
                <h4>Thanh toán tiền phòng thành công!</h4>
              </div>
            </div>
           <div class='col-lg-12'>
            <div class='form-group '>
                <button type='submit' class='btn btn-success btn-sm'>In Hoá Đơn</button>
            </div>
            </div> 
          </div>";
        }
        
    }

    //in hoá đơn tiền phòng
    public function print(Request $request){
        $idThanhToan = $request->idThanhToan;
        $getItemPaymentRoom = $this->paymentroom->getItemPaymentRoom($idThanhToan);
        $ngayLap = $getItemPaymentRoom->ngayThanhToan;
        $idOrder = $getItemPaymentRoom->idThuePhong;
        $getItemOrderRoom  = $this->order->getItemEditOrder($idOrder);
        $getItemRoom = $this->room->getItemEditRoom($getItemOrderRoom->id_room);
        if(Auth::check()){
            $idTaiKhoan = Auth::user()->id;
            $TaiKhoan = User::find(Auth::user()->id);
            $nameAdmin = $TaiKhoan->admin->tenDayDu;
            $diaChiAdmin = $TaiKhoan->admin->diaChi;   
        }
        $ngayThanhToan = Carbon::now('Asia/Ho_Chi_Minh');
        $ngayThanhToan = Carbon::parse($ngayThanhToan)->format('H:m:s d/m/Y');
            //dd($getItemRoom->serviceRoom);
        $dichVu = $getItemRoom->serviceRoom;
        $name_floor = $getItemRoom->floor->name_floor;
        $name_room = $getItemRoom->name_room;
        $data = [
            'phong' => $name_room,
            'tang' =>$name_floor,
            'nameAdmin' => $nameAdmin,
            'diaChiAdmin' => $diaChiAdmin,
            'ngayThanhToan' =>$ngayThanhToan,
            'giaPhongHienTai'   => $getItemOrderRoom->price_room,
            'dichVu' =>$dichVu,
            'tienCoc' => $getItemOrderRoom->deposits,
            'tienPhaiTra' =>$getItemOrderRoom->money_last,
        ];
        //dd($data);
        $pdf = PDF::loadView('admin/hoadon/hoadonphong',\compact('data'));
        return $pdf->download('hoadonphong.pdf');
    }

   
    
}
