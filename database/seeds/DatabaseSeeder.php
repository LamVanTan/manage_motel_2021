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
        $this->call(DatabaseSeederUser::class);
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
