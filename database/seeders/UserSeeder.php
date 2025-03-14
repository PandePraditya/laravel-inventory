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
        $users = [
            [
                'full_name' => 'Admin Account', 
                'email' => 'admin@gmail.com', 
                'password' => Hash::make('password'), 
                'phone_number' => '081234567890', 
                'role_id' => 1, // 1 for admin role only
                'division_id' => 1
            ],
            [
                'full_name' => 'Regular User',  
                'email' => 'user@gmail.com', 
                'password' => Hash::make('password'), 
                'phone_number' => '081234567891', 
                'role_id' => 2, // Optional: already default as 2 or 'user' role
                'division_id' => 2
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
