<?php

namespace App\Http\Controllers\Motel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Room;
use App\User;
class DetailRoomController extends Controller
{
    public function __construct(Room $room, User $user){
        $this->room = $room;
        $this->user = $user;
    }
    public function detailRoom($slug,$idRoom){
        $getItemRoom = $this->room->getItemEditRoom($idRoom);
        $getListUser = $this->user->getListUser();
        $getListRoomUser = $this->room->getListRoomUser($idRoom);
        return view('motel.room.detail',\compact('getItemRoom','getListUser','getListRoomUser'));
    }
}
