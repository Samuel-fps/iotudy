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
        User::create([
            'name' => 'Paloma García',
            'email' => 'paloma@gmail.com',
            'password' => Hash::make('123456'),
        ]);

        User::create([
            'name' => 'Samuel Fernández',
            'email' => 'samuel@gmail.com',
            'password' => Hash::make('123456'),
        ]);

        User::factory(10)->create();
    }
}
