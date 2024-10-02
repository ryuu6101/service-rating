<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Quản lý',
                'username' => 'quanly',
                'password' => bcrypt('123456'),
                'role_id' => 1
            ],
            [
                'name' => 'Nhân viên',
                'username' => 'nhanvien',
                'password' => bcrypt('123456'),
                'role_id' => 2
            ],
        ];

        User::truncate();
        User::insert($data);
    }
}
