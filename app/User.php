<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
class User extends Authenticatable
{
    use Notifiable;
    protected $table = 'users';
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','permission',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function admin(){
        return $this->hasOne('App\Models\Admin', 'idUser');
    }

    public function bank()
    {
        return $this->hasOne('App\Models\BankUser', 'id_user');
    }

    // public function RoomsAdmin()
    // {
    //     return $this->hasMany('App\Models\Room', 'MaTaiKhoan');
    // }

    //phan public
    public function itemUser($idUser){
        return User::where('id', $idUser)->first();
    }
    public function addUser($data){
        return DB::table('users')->insertGetId($data); 
    }
    public function updateUser($data, $idUser){
        return DB::table('users')->where('id', $idUser)->update($data); 
    }

    public function getListUser(){
        return User::all();
    }

    //phanf quan ly system
    public function total_price_app($month, $year){
        return DB::table('users')
        ->whereYear('ngayBatDau', $year)
        ->whereMonth('ngayBatDau', $month)
        ->where('permission','<>', 2)
        ->sum('priceApp'); 
    }

    public function total_user($month, $year){
        return DB::table('users')
        ->whereYear('ngayBatDau', $year)
        ->whereMonth('ngayBatDau', $month)
        ->where('permission','<>', 2)
        ->count('id'); 
    }

    public function listUser(){
        return User::where('permission', 1)->orderBy('id','desc')->get();
    }
    
}
