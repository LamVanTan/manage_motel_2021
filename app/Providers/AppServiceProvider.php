<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Room;
use App\Models\Service;
use App\Models\Floor;
use App\Models\OrderRoom;
use App\Models\Customer;
use App\Models\PaymentRoom;
use App\Models\Payment;
use App\Models\BankUser;
use App\User;
use URL;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::share('urlAdmin',getenv('URL_ADMIN'));
        View::share('adminImages', \getenv('ADMIN_IMAGES'));
        View::share('adminUrl', getenv('LOGIN'));
        URL::forceScheme('https');
        //share room
        view()->composer('*', function ($view) 
        {
            if(Auth::check()){
                $idUser = Auth::user()->id;
            
             $listRoomShare = Room::where('status_room', 1)
             ->where('MaTaiKhoan', $idUser)
             ->where('condition_room', 0)
             ->get();
             $listServiceShare = Service::where('MaTaiKhoan', $idUser)
             ->where('status_service', 1)
             ->get();
             $listFloorShare = Floor::where('MaTaiKhoan', $idUser)
             ->where('status_floor', 1)
             ->get();
            $soDuTaiKhoan = BankUser::where('id_user', $idUser)->first();
            $total_Order = OrderRoom::where('MaTaiKhoan', $idUser)->count();
            $total_Customer = Customer::where('MaTaiKhoan', $idUser)->count();
            $total_price_room = PaymentRoom::where('idAdmin',$idUser)->where('tinhTrang', 1)->sum('soTienTra');
            $total_price_DN = Payment::where('idAdmin',$idUser)->where('tinhTrang', 1)->sum('tongTienThanhToan');
            if($total_price_DN){
                $total_price_DN = $total_price_DN;
            }else{
                $total_price_DN = 0;
            }
            $total_price_DT = $total_price_room + $total_price_DN;

            $total_user = User::where('permission',1)
            ->count('id');

            $total_price_app = User::where('permission', 1)
            ->sum('priceApp'); 
            $total_price_bank = BankUser::sum('soTienNap');

            $revenueSystem = $total_price_app + $total_price_bank; 
            view::share(compact('listRoomShare','listServiceShare','listFloorShare',
             'soDuTaiKhoan','total_Order','total_Customer','total_price_room',
             'total_price_DN','total_price_DT','total_user','revenueSystem'));
            }
        }); 
    }
}
