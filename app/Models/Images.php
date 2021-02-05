<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class Images extends Model
{
    protected $table = 'HinhAnh';
    protected $primaryKey = 'id_images';

    //model-eloquent-ORM
    public function room()
	{
	    return $this->belongsTo('App\Models\Room', 'id_room');
    }
    public function customer()
	{
	    return $this->belongsTo('App\Models\Customer', 'id_customer');
    }
   
    //admin-add-room
    public function addImagesRoom($data){
        return DB::table('HinhAnh')->insert($data);
    }
}
