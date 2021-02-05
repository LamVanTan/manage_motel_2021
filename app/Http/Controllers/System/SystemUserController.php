<?php

namespace App\Http\Controllers\System;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Admin;
class SystemUserController extends Controller
{
    public function __construct(User $user, Admin $admin){
        $this->user = $user;
        $this->admin = $admin;
    }
    public function index(){
        
        $listUser = $this->user->listUser();
        return view('system.user.index',\compact('listUser'));
    }
}
