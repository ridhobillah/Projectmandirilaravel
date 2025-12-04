<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'nik' => '12345678',
            'position' => 'admin',
            'wages' => '12345678',
            'numberphone' => '12345678',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('AdminChaos')
        ]);
    }
}
