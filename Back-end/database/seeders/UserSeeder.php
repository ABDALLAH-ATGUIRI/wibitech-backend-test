<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'admin123',
            'first_name' => 'Admin',
            'last_name' => 'User',
            'password' => Hash::make('Pa$$0rd_123'),
            'role' => 'admin',
        ]);

        User::create([
            'username' => 'user123',
            'first_name' => 'Normal',
            'last_name' => 'User',
            'password' => Hash::make('Pa$$0rd_123'),
            'role' => 'user',
        ]);

        User::create([
            'username' => 'abdallah.atguiri',
            'first_name' => 'ABDALLAH',
            'last_name' => 'ATGUIRI',
            'password' => Hash::make('Pa$$0rd_123'),
            'role' => 'admin',
        ]);
    }
}
