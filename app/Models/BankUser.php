<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class BankUser extends Model
{
    protected $table = 'TienSuDungWebsite';
    protected $primaryKey = 'id';

    public function userBank(){
        return $this->belongsTo('App\User', 'id');  
    }

    public function updateBankUser($data,$idUser){
        return DB::table('TienSuDungWebsite')->where('id_user', $idUser)->update($data);
    }
    public function insertBankUser($data){
        return DB::table('TienSuDungWebsite')->insert($data);
    }
    public function total_price_bank($month,$year){
        return DB::table('TienSuDungWebsite')
        ->whereYear('ngayNap', $year)
        ->whereMonth('ngayNap', $month)
        ->sum('soTienNap');
    }
}
