<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => 1,
                'title' => 'Quản lý',
                'slug' => 'quan_ly',
            ],
            [
                'id' => 2,
                'title' => 'Nhân viên',
                'slug' => 'nhan_vien',
            ],
        ];

        Role::truncate();
        Role::insert($data);
    }
}
