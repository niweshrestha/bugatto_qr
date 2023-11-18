<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::create([
            'username' => 'admin.bugatti',
            'email' => 'info@bugatti-e.com',
            'password' => Hash::make('bugatti123'),
            'role' => 'admin'
        ]);

        \App\Models\User::create([
            'username' => 'superadmin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('superadmin4780@'),
            'role' => 'superadmin'
        ]);
    }
}
