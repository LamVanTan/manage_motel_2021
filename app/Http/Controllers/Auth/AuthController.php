<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\User;
use App\Models\PriceApp;
use App\Models\BankUser;
use App\Http\Requests\TaiKhoan;
use App\Http\Requests\loginRequest;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function __construct(User $user, Admin $taikhoan, PriceApp $app, BankUser $bankUser){
        $this->user = $user;
        $this->taikhoan = $taikhoan;
        $this->app = $app;
        $this->bankUser = $bankUser;
    }

    public function logoutAdmin(){
        
        Auth::logout();
        return redirect()->route('motel.auth.login');
    }

    public function login(){
        return view('motel.auth.login');
    }

    public function postLogin(loginRequest $request){
        //dd($request->all());
        $username = $request->username;
        $password = $request->password;
        $ngayHientai = Carbon::now('Asia/Ho_Chi_Minh');
        $donGiaUngDung = $this->app->getPriceApp();
        if (Auth::attempt(['email'=>$username,'password'=>$password, 'permission'=> 1])) {  
            $ngayKetThuc = Auth::user()->ngayKetThuc;
            //dd(date("d-m-Y"));
            if( date('d-m-Y', strtotime($ngayHientai->addDay(1))) == date('d-m-Y', strtotime($ngayKetThuc)) ){ 
                return redirect()->route('admin.index.index')->with('warning', 'Tài khoản quản lý của bạn chỉ còn 1 ngày nữa hết hạng mong bạn gia hạn thời gian sử dụng'); 
            }else if( date("Y-m-d") >= date('Y-m-d', strtotime($ngayKetThuc))){
                
                $idUser = User::find(Auth::user()->id);
                if($idUser->bank == false){
                    $data = [
                        'permission' => 0
                    ];
                    $updateUser = $this->user->updateUser($data,Auth::user()->id);
                    if($updateUser){
                        return redirect()->back()->with('msg', 'Số dư trong tài khoản của bạn không đủ điều kiện gia hạn sử dụng website');
                    }
                }
                else{
                    
                    if($idUser->bank->soDuTaiKhoan < $donGiaUngDung->giaTien){

                        $data = [
                            'permission' => 0
                        ];
                        $updateUser = $this->user->updateUser($data,Auth::user()->id);
                        if($updateUser){
                            return redirect()->back()->with('msg', 'Số dư trong tài khoản của bạn không đủ điều kiện gia hạn sử dụng website');
                        }
                    }else{
                        $ngayBatDau = Carbon::now('Asia/Ho_Chi_Minh');
                        $ngayKetThuc = Carbon::now('Asia/Ho_Chi_Minh')->addMonths(1);
                        $soDuTaiKhoan = ($idUser->bank->soDuTaiKhoan) - $donGiaUngDung->giaTien;
                        $data = [
                            'soDuTaiKhoan' => $soDuTaiKhoan,
                            'ngayNap' => $ngayBatDau
                        ];
                        $updateBankUser = $this->bankUser->updateBankUser($data, Auth::user()->id);
                        if($updateBankUser){
                            $data = [
                                'ngayBatDau' => $ngayBatDau,
                                'ngayKetThuc' => $ngayKetThuc,
                                'priceApp' => $idUser->priceApp + $donGiaUngDung->giaTien
                            ];
        
                            $updateUser = $this->user->updateUser($data, Auth::user()->id);
                            if($updateUser){
                                $mess = 'Tài khoản quản lý của bạn vừa được gia hạn tới ngày '.Carbon::parse($ngayKetThuc)->format('H:m:s d/m/Y');
                                return redirect()->route('admin.index.index')->with('thanhToanTien', $mess);
                            }
                        }
                    }
                }
            }else{
                return redirect()->route('admin.index.index');
            }
        }
        else if(Auth::attempt(['email'=>$username,'password'=>$password, 'permission'=> 0])){
            return redirect()->route('motel.index.index');
        } 
        else{
            return redirect()->back()->with('msg', 'Sai tên đăng nhập hoặc mật khẩu');
        }
    }

    public function register(){
        return view('motel.auth.register');
    }

    public function postRegister(TaiKhoan $request){
        $request = $request->all();
        //dd($request);
        $giaTienTaiKhoanQuanLy = $this->app->getPriceApp();
        //phương thức đăng ký tài khoản quản lý
        if($request['taikhoan'] == 1){
            $data = [
                'email' => $request['email'],
                'password' => bcrypt($request['password']),
                'permission' => 0
            ];
            $addUser = $this->user->addUser($data);
            if($addUser){
                $data = [
                    'tenDayDu' => $request['fullname'],
                    'SDT'   =>  $request['phone'],
                    'gioiTinh'  =>  $request['gioitinh'],
                    'idUser'    =>  $addUser,
                    'diaChi'    => $request['address']
                ];
                $addTaiKhoan = $this->taikhoan->addTaiKhoan($data);
            }
            return view('motel.auth.paymentRegister', \compact('addUser','giaTienTaiKhoanQuanLy') );
        }else{
            $data = [
                'email' => $request['email'],
                'password' => bcrypt($request['password']),
                'permission' => 0
            ];
            $addUser = $this->user->addUser($data);
            if($addUser){
                $data = [
                    'tenDayDu' => $request['fullname'],
                    'SDT'   =>  $request['phone'],
                    'gioiTinh'  =>  $request['gioitinh'],
                    'idUser'    =>  $addUser,
                    'diaChi'    => $request['address']
                ];
                $addTaiKhoan = $this->taikhoan->addTaiKhoan($data);
                if($addTaiKhoan){
                    return \redirect()->route('motel.auth.login')->with('msg', "Đăng ký tài khoản thành công mời bạn đăng nhập");
                }
            }
        }
    }

    public function priceApp(Request $request){
       $priceApp =  $request->priceApp;
       $month = $request->month;
       $priceApp = $month * $priceApp;
       echo ' '.number_format($priceApp,0,',','.').' vnđ';
    }

    public function paymentRegister(){
        $giaTienTaiKhoanQuanLy = $this->app->getPriceApp();
        return view('motel.auth.paymentRegister', \compact('giaTienTaiKhoanQuanLy'));
    }

    public function paymentRegisterAjax(Request $request){
        $idUser = $request->idUser;
        $price = $request->price;
        $month = $request->month;
        $ngayBatDau = Carbon::now('Asia/Ho_Chi_Minh');
        $ngayKetThuc = Carbon::now('Asia/Ho_Chi_Minh')->addMonths($month);
        $data = [
            'ngayBatDau' => $ngayBatDau,
            'ngayKetThuc' => $ngayKetThuc,
            'permission' => 1,
            'priceApp'  => $price
        ];
               $updateUser = $this->user->updateUser($data,$idUser);
               if($updateUser){
                 return "<p style='padding-left: 1%; color: green;'>Đăng ký tài khoản quản lý thành công</p>";
               }

    }   

    public function payment(Request $request){
        $vnp_Url = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        //$vnp_Returnurl = "http://localhost/vnpay_php/vnpay_return.php";
        $vnp_TmnCode = "Y4U88XFK";//Mã website tại VNPAY 
        $vnp_HashSecret = "DTHXNFNBUMNKFKQOZVHTXUXNUQUUXMTV"; //Chuỗi bí mật
        $vnp_ReturnUrl = route('payment-vnpay-register');

        $vnp_TxnRef = $request->order_id;//Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = $request->order_desc;
        $vnp_OrderType = $request->order_type;
        $vnp_Amount = $request->amount * 100;
        $vnp_Locale = $request->language;
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $vnp_BankCode = $request->bank_code;
        $inputData = array(
            "vnp_Version" => "2.0.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,   
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_ReturnUrl,
            "vnp_TxnRef" => $vnp_TxnRef,    
        );
        
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . $key . "=" . $value;
            } else {
                $hashdata .= $key . "=" . $value;
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash('sha256',$vnp_HashSecret . $hashdata);
            $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
        }
        return redirect()->to($vnp_Url);
    }

    public function getpayment(Request $request){
        $data = $request->all();
        //dd($data);
        $vnp_SecureHash = $data['vnp_SecureHash'];
        $vnp_HashSecret = "DTHXNFNBUMNKFKQOZVHTXUXNUQUUXMTV";
        $inputData = array();
        foreach ($_GET as $key => $value) {
            $inputData[$key] = $value;
        }
        unset($inputData['vnp_SecureHashType']);
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . $key . "=" . $value;
            } else {
                $hashData = $hashData . $key . "=" . $value;
                $i = 1;
            }
        }
        $secureHash = hash('sha256',$vnp_HashSecret . $hashData);
        $array = array();
        if ($secureHash == $vnp_SecureHash) {
            if ($_GET['vnp_ResponseCode'] == '00') {
               $idUser = $data['vnp_TxnRef'];
               $price = $data['vnp_Amount']/100;
               $month = $price/199000;
               $ngayBatDau = Carbon::now('Asia/Ho_Chi_Minh');
               $ngayKetThuc = Carbon::now('Asia/Ho_Chi_Minh')->addMonths($month);
               $data = [
                   'ngayBatDau' => $ngayBatDau,
                   'ngayKetThuc' => $ngayKetThuc,
                   'permission' => 1,
                   'priceApp'  => $price
               ];
               $updateUser = $this->user->updateUser($data,$idUser);
               if($updateUser){
                return \redirect()->route('motel.auth.paymentRegister')->with('msg', "Đăng ký tài khoản quản lý thành công");
               }
            } else {
                echo 'đ';
            }
        } else {
            echo "Chu ky khong hop le";
        }
    } 
    //login-system
    public function loginSystem(){
        return view('system.auth.login');
    }

    public function postLoginSystem(Request $request){
        $username = $request->username;
        $password = $request->password;
        if (Auth::attempt(['email'=>$username,'password'=>$password, 'permission'=> 2])) { 
            return redirect()->route('system.index.index');
        } else{
            return redirect()->back()->with('msg', 'Sai tên đăng nhập hoặc mật khẩu');
        }
    }
}
