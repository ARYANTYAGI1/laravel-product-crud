<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;  // Add this line


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create the super admin with userType 1
        User::create([
            'name' => 'Super Admin',         // Name of the admin
            'email' => 'admin@yopmail.com',  // Email address
            'password' => Hash::make('password123'),  // Password (hashed)
            'userType' => 1,  // userType 1 for Super Admin
        ]);
    }
}
