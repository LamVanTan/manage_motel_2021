<?php

namespace App\Http\Controllers\Motel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
class CustomerController extends Controller
{
    public function __construct(User $user){
        $this->user = $user;
    }
    public function index(){
       if(Auth::check()){
           if(Auth::user()->permission == 0){
               $itemUser = $this->user->itemUser(Auth::user()->id);
           }
       }
        return view('motel.customer.index',\compact('itemUser'));
    }
}
