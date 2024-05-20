<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Test user
        User::updateOrCreate([
            'email' => 'test@gmail.com',
        ], [
            'name' => 'testuser',
            'role' => 'admin',
            'password' => bcrypt('secret'),
        ]);

        User::updateOrCreate([
            'email' => 'admin@gmail.com',
        ], [
            'name' => 'adminuser',
            'role' => 'admin',
            'password' => bcrypt('secret'),
        ]);

        User::updateOrCreate([
            'email' => 'user@gmail.com',
        ], [
            'name' => 'user',
            'role' => 'user',
            'password' => bcrypt('secret'),
        ]);

        User::updateOrCreate([
            'email' => 'zwei@gmail.com',
        ], [
            'name' => 'user2',
            'role' => 'user',
            'password' => bcrypt('secret'),
        ]);

        User::updateOrCreate([
            'email' => 'drei@gmail.com',
        ], [
            'name' => 'user3',
            'role' => 'user',
            'password' => bcrypt('secret'),
        ]);
    }
}
