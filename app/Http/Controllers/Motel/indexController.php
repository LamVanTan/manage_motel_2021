<?php

namespace App\Http\Controllers\Motel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Room;
use App\User;
class indexController extends Controller
{
    public function __construct(Room $room, User $user){
        $this->room = $room;
        $this->user = $user;
    }
    public function index(){
        //pin-room
        //$getListRoomsPin = $this->room->getListRoomsPin();
        //$getListUser = $this->user->getListUser();
        //room-
       // $getListRooms = $this->room->getListRooms();
       return redirect()->route('motel.auth.login');
       // return view('motel.index.index', \compact('getListRoomsPin','getListUser','getListRooms'));
    }
    // return redirect()->route('motel.auth.login');

    // public function timePinRooms(Request $request){
    //     $idRoom = $request->idRoom;
    //     $data = [
    //         'PinRooms' => 2
    //     ];
    //     $updateItemPinRoom = $this->room->editItemRoom($data,$idRoom);
    //     return view('motel.index.hotnews');
    // }
}
