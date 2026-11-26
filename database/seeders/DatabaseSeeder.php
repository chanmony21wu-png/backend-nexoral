<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // the admin account. CHANGE THIS PASSWORD after your first login.
        User::firstOrCreate(
            ['email' => 'mony123@gmail.com'],
            ['name' => 'Admin', 'password' => Hash::make('admin12345')]
        );

        $this->call(ProductSeeder::class);
    }
}