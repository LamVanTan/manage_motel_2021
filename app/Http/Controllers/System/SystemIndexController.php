<?php

namespace App\Http\Controllers\System;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
Use App\User;
Use App\Models\BankUser;
use Carbon\Carbon;
class SystemIndexController extends Controller
{
    public function __construct(BankUser $bank, User $user){
        $this->bank = $bank;
        $this->user = $user;
    }
    public function index(){
        $year = Carbon::now('Asia/Ho_Chi_Minh')->year;
        $revenue = array();
        for($month = 1; $month <= 12;$month++){
            $total_price_app = $this->user->total_price_app($month,$year);
            if($total_price_app){
                $total_price_app = $total_price_app;
            }else{
                $total_price_app = 0;
            }
            $total_price_bank = $this->bank->total_price_bank($month,$year);
            $doanhThu = $total_price_app + $total_price_bank;
            $revenue[$month] = $doanhThu;
        }
        $total_user_app = array();
        for($month = 1; $month <= 12;$month++){
            $total_user = $this->user->total_user($month,$year);
            if($total_user){
                $total_user = $total_user;
            }else{
                $total_user = 0;
            }
           
            $total_user_app[$month] = $total_user;
        }

        return view('system.index.index',\compact('revenue','year','total_user_app'));
    }

    public function revenueAjax(Request $request){
        $year = $request->year;
        
        $revenue = array();
        for($month = 1; $month <= 12;$month++){
            $total_price_app = $this->user->total_price_app($month,$year);
            if($total_price_app){
                $total_price_app = $total_price_app;
            }else{
                $total_price_app = 0;
            }
            $total_price_bank = $this->bank->total_price_bank($month,$year);
            $doanhThu = $total_price_app + $total_price_bank;
            $revenue[$month] = $doanhThu;
        }
        
        return view('system.index.revenue',\compact('revenue','year'));
        
    }

    public function yearOrderAjax(Request $request){
        $year = $request->year;
        $total_user_app = array();
        for($month = 1; $month <= 12;$month++){
            $total_user = $this->user->total_user($month,$year);
            if($total_user){
                $total_user = $total_user;
            }else{
                $total_user = 0;
            }
           
            $total_user_app[$month] = $total_user;
        }

        
        return view('system.index.totalregister',\compact('total_user_app','year'));
        
    }

}
