<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Tests\TestModels\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


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
        ])->assignRole('Admin');

        User::create([
            'name' => 'Samuel Fernández',
            'email' => 'samuel@gmail.com',
            'password' => Hash::make('123456'),
        ])->assignRole('Author');

        User::factory(10)->create();
    }
}
