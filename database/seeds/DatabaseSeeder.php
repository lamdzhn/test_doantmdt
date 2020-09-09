<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'lam',
            'name' => 'Nguyễn Đức Lâm',
            'email' => 'lamdepzaihn98@gmail.com',
            'password' => bcrypt('123456'),
            'gender' => '1',
            'birthday' => '1998-08-31',
            'phone_number' => '0123456789',
            'address' => '175 Tây Sơn, Đống Đa, Hà Nội',
            'permission' => '1',
            'status' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('users')->insert([
            'username' => 'lam1',
            'name' => 'Nguyễn Đức Lâm',
            'email' => 'crazydanger3108@gmail.com',
            'password' => bcrypt('123456'),
            'gender' => '1',
            'birthday' => '1998-08-31',
            'phone_number' => '0123456789',
            'address' => '175 Tây Sơn, Đống Đa, Hà Nội',
            'permission' => '1',
            'status' => '0',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('attributes')->insert([
           'name' => 'Màu sắc',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('attributes')->insert([
            'name' => 'Kích cỡ',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
