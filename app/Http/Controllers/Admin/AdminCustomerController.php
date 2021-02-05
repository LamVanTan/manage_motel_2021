<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\OrderRoom;
use Illuminate\Support\Facades\Auth;
class AdminCustomerController extends Controller
{
    public function __construct(Customer $customer,OrderRoom $order){
        $this->customer = $customer;
        $this->order = $order;
    }
    public function index(){
        if(Auth::check()){
            $idUser = Auth::user()->id;
        }
        $listOrderRoom = $this->order->getListOrder($idUser);
        return view('admin.customer.index',\compact('listOrderRoom'));
    }
}
