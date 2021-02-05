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
        $this->call(DatabaseSeederApp::class);
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
