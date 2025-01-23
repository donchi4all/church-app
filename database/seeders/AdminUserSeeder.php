<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@example.com'], // Check by email to avoid duplicates
            [
                'name' => 'Admin User',
                'password' => bcrypt('password'),
                'is_admin' => true, // Mark as admin
            ]
        );
    }
}
