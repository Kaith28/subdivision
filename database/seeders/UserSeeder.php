<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin account
        User::create([
            'name' => 'TEST ADMIN',
            'email' => 'testadmin@gmail.com',
            'password' => bcrypt('12345678'),
            'company_name' => 'Subdi',
            'role' => 'admin',
        ]);
        User::create([
            'name' => 'Resident',
            'email' => 'resident@gmail.com',
            'password' => bcrypt('password'),

            'role' => 'resident',
        ]);
        User::create([
            'name' => 'TEST GUARD',
            'email' => 'testguard@gmail.com',
            'password' => bcrypt('12345678'),

            'role' => 'guard',
        ]);
        User::create([
            'name' => 'Ticycle Driver',
            'email' => 'tricycledriver@gmail.com',
            'password' => bcrypt('password'),

            'role' => 'driver',
        ]);
    }
}
