<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminData = [
            [
                'name' => 'Super Admin',
                'email' => 'super@gmail.com',
                'mobile' => '01777873960',
                'password' => bcrypt('12345678'),
            ],
        ];
        DB::table('admins')->insert($adminData);

        $userData = [
            [
                'name' => 'User',
                'email' => 'user@gmail.com',
                'mobile' => '01777873960',
                'password' => bcrypt('12345678'),
            ],
            [
                'name' => 'User 2',
                'email' => 'user2@gmail.com',
                'mobile' => '01777873961',
                'password' => bcrypt('12345678'),
            ],
        ];
        DB::table('users')->insert($userData);
    }
}
