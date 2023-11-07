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
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'company_name' => 'Subdi',
            'role' => 'owner',
        ]);
        User::create([
            'name' => 'Resident',
            'email' => 'resident@gmail.com',
            'password' => bcrypt('password'),
            
            'role' => 'resident',
        ]);
        User::create([
            'name' => 'Guard',
            'email' => 'guard@gmail.com',
            'password' => bcrypt('password'),
        
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
