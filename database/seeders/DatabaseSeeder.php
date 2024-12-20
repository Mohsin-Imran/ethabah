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
            'name' => 'Investor',
            'email' => 'investor@gmail.com',
            'password' => bcrypt('123456789'),
            // 'passport' => asset('investor_register/1733249368.jpeg'),
            // 'national_id' => asset('investor_register/1733249368.jpeg'),
            'email_verified_at' => now(),
            'role' => 0,
            'phone' => 1213213213,
            'address' => "123 Fake Street, New York, NY 10001, USA",
        ]);
    }
}
