<?php

namespace Database\Seeders;

use App\Models\User;
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
    User::firstOrCreate(
        ['email' => 'admin@example.com'],
        [
            'name' => 'Admin',
            'password' => Hash::make('secretpassword'),
            'incentive_tier' => 'bronze',
            'is_admin' => 1,
        ]
    );

        User::firstOrCreate(
        ['email' => 'user@example.com'],
        [
            'name' => 'Regular User',
            'password' => Hash::make('secretpassword1'),
            'incentive_tier' => 'bronze',
            'is_admin' => 0,
        ]
    );
}
}
