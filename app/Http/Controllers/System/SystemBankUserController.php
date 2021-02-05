<?php

namespace App\Http\Controllers\System;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\BankUser;
class SystemBankUserController extends Controller
{
    public function __construct(BankUser $bank, User $user){
        $this->bank = $bank;
        $this->user = $user;
    }

    public function index(){
        $listUser = $this->user->listUser();
        return view('system.bankUser.index',\compact('listUser'));
    }

}
