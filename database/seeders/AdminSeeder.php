<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'rida@reservme.com'],
            [
                'name' => 'Rida',
                'password' => Hash::make('rida4you'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'nico@reservme.com'],
            [
                'name' => 'Nico',
                'password' => Hash::make('nico4you'),
                'role' => 'admin',
            ]
        );
    }
}
