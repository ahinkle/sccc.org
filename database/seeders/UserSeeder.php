<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Andy Hinkle',
            'email' => 'ahinkle10@gmail.com',
            'password' => Hash::make('password'),
        ]);
    }
}
