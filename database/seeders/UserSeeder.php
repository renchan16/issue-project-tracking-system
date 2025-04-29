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
        // Create the Admin user
        User::firstOrCreate(
            ['email' => 'admin@trackr.com'], // Check if user with this email exists
            [
                'name' => 'Admin',
                'password' => Hash::make('adminadminadmin'),
                'role' => 'admin',
                'email_verified_at' => now(), // Optionally mark as verified
            ]
        );

        // You could add more default users here if needed
        // User::factory(10)->create(); // Example: create 10 random users
    }
}
