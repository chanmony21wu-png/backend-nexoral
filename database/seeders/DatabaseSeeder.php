<?php


namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@nexora.test'],
            [
                'name' => 'Admin',
                'password' => Hash::make('11112222admin'),
            ]
        );
    }
}
