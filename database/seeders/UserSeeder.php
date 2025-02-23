<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Seed Users (Example)
        User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',  // Example role (admin, student, teacher)
        ]);

        User::create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'password' => Hash::make('password123'),
            'role' => 'teacher',  // Example role
        ]);

        User::create([
            'name' => 'Mark Johnson',
            'email' => 'mark@example.com',
            'password' => Hash::make('password123'),
            'role' => 'student',  // Example role
        ]);
    }
}
