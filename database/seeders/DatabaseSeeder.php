<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => 'admin@123',
            'email_verified_at' => now(),
            'role' => 1,
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Customer',
            'email' => 'customer@gmail.com',
            'password' => '123456789',
            'email_verified_at' => now(),
            'role' => 0,
        ]);
    }
}
