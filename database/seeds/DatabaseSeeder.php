<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DatabaseSeederRoom::class);
    }
}

class DatabaseSeederApp extends Seeder
{

    public function run()
    {
        DB::table('DonGiaUngDung')->insert([
            'id_dongia' => '1',
            'trangthai' => '1',
            'giaTien' => 199000,
        ]);
    }
}
// class DatabaseSeederRoom extends Seeder
// {

//     public function run()
//     {
//         DB::table('Phong')->insert([
//             'name_room' => 'A1',
//             'price_room' => 2000000,
//             'area_room' => 20,
//             'person_quantity' => 2,
//             'detail_room' => 'Phong thoang mat',
//             'status_room' => 1,
//             'condition_room' => 0,
//             'price_last' => 2000000,
//             'chiSoDienBanDau' => 0,
//             'chiSoNuocBanDau' => 0,
//             'pinRooms' => 1,
//             'ngayHetHanPin' => '2021-02-08 19:51:34',
//             'MaTaiKhoan' => 1,
//             'id_floor' =>1,
//             'id_roomtype' => 1
//         ]);
//     }
// }


class DatabaseSeederUser extends Seeder
{

    public function run()
    {
        DB::table('users')->insert([
            'email' => 'lamvantan03@gmail.com',
            'password' => bcrypt('123123'),
            'permission' => 1,
            'ngayBatDau' => '2021-02-05 19:51:34',
            'ngayKetThuc' => '2021-03-05 19:51:34',
            'priceApp'  => 199000
        ]);
    }
}


class DatabaseSeederFloor extends Seeder
{

    public function run()
    {
        DB::table('Tang')->insert([
            'name_floor' => 'Tang 1',
            'status_floor' => 1,
            'MaTaiKhoan' => 1
        ]);
    }
}


class DatabaseSeederRoomType extends Seeder
{

    public function run()
    {
        DB::table('LoaiPhong')->insert([
            'name_roomtype' => 'Tang 1',
            'status_roomtype' => 1,
            'MaTaiKhoan' => 1
        ]);
    }
}
