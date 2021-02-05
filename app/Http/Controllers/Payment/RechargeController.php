<?php

namespace App\Http\Controllers\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
Use App\User;
Use App\Models\BankUser;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class RechargeController extends Controller
{
    public function __construct(BankUser $bank){
        $this->bank = $bank;
    }
    public function recharge(){
        return view('motel.payment.recharge');
    }
    public function ajaxRecharge(Request $request){
        $tienNapVao = $request->money;
        if(Auth::check()){
            $idUser = Auth::user()->id; 
        }
        $taiKhoan = User::find($idUser);
        if($taiKhoan->bank == false){
            $soDuTaiKhoan = 0;
            $tienNapVao = $tienNapVao + $soDuTaiKhoan;
            $ngayNap = Carbon::now('Asia/Ho_Chi_Minh');
            $data = [
                'soDuTaiKhoan' => $tienNapVao,
                'id_user'      => $idUser,
                'ngayNap'      => $ngayNap,
                'soTienNap'    => $tienNapVao
            ];
            $resultBankUser = $this->bank->insertBankUser($data);
        }else{
            $soDuTaiKhoan = $taiKhoan->bank->soDuTaiKhoan;
            $tienNapVao = $tienNapVao + $soDuTaiKhoan;
            $data = [
                'soDuTaiKhoan' => $tienNapVao,
                'id_user'      => $idUser,
                'ngayNap'      => $ngayNap,
                'soTienNap'    => $tienNapVao
            ];
            $resultBankUser =  $this->bank->updateBankUser($data,$idUser);
        }  
        if($resultBankUser){
            return "<p style='padding-left: 1%; color: green;'>Nạp tiền thành công</p>";
        }  
    }

    public function payment(Request $request){
        $vnp_Url = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        //$vnp_Returnurl = "http://localhost/vnpay_php/vnpay_return.php";
        $vnp_TmnCode = "Y4U88XFK";//Mã website tại VNPAY 
        $vnp_HashSecret = "DTHXNFNBUMNKFKQOZVHTXUXNUQUUXMTV"; //Chuỗi bí mật
        $vnp_ReturnUrl = route('payment-vnpay');

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
        if ($secureHash == $vnp_SecureHash) {
            if ($_GET['vnp_ResponseCode'] == '00') {
                $tienNapVao = $data['vnp_Amount']/100;
                if(Auth::check()){
                    $idUser = Auth::user()->id; 
                }
                $taiKhoan = User::find($idUser);
                if($taiKhoan->bank == false){
                    $soDuTaiKhoan = 0;
                    $tienNapVao = $tienNapVao + $soDuTaiKhoan;
                    $ngayNap = Carbon::now('Asia/Ho_Chi_Minh');
                    $data = [
                        'soDuTaiKhoan' => $tienNapVao,
                        'id_user'      => $idUser,
                        'ngayNap'      => $ngayNap,
                        'soTienNap'    => $tienNapVao
                    ];
                    $resultBankUser = $this->bank->insertBankUser($data);
                }else{
                    $soDuTaiKhoan = $taiKhoan->bank->soDuTaiKhoan;
                    $tienNapVao = $tienNapVao + $soDuTaiKhoan;
                    $data = [
                        'soDuTaiKhoan' => $tienNapVao,
                        'id_user'      => $idUser,
                        'ngayNap'      => $ngayNap,
                        'soTienNap'    => $tienNapVao
                    ];
                    $resultBankUser =  $this->bank->updateBankUser($data,$idUser);  
                }
                return \redirect()->route('motel.room.recharge')->with('msg', "Nạp tiền thành công");
            } else {
                return \redirect()->route('motel.room.recharge')->with('msg', "Giao dịch không thanh công");
            }
        } else {
            echo "Chu ky khong hop le";
        }
    }
}
