<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class PriceApp extends Model
{
    protected $table = 'DonGiaUngDung';
    protected $primaryKey = 'id_dongia';

    public function getPriceApp(){
        return DB::table('DonGiaUngDung')->where('trangthai', 1)->first();
    }
}
