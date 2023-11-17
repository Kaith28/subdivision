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
            'name' => 'TEST owner',
            'email' => 'testowner@gmail.com',
            'password' => bcrypt('12345678'),
            'company_name' => 'Subdi',
            'role' => 'owner',
        ]);
        User::create([
            'name' => 'TEST ADMIN',
            'email' => 'testadmin@gmail.com',
            'contact_no' => '09123456789',
            'password' => bcrypt('12345678'),
            'role' => 'admin',
        ]);
        User::create([
            'name' => 'Admin1',
            'email' => 'admin1@gmail.com',
            'contact_no' => '09123456789',
            'password' => bcrypt('12345678'),
            'role' => 'admin',
        ]);
        User::create([
            'name' => 'Admin2',
            'email' => 'admin2@gmail.com',
            'contact_no' => '09123456789',
            'password' => bcrypt('12345678'),
            'role' => 'admin',
        ]);
        User::create([
            'name' => 'Admin3',
            'email' => 'admin3@gmail.com',
            'contact_no' => '09123456789',
            'password' => bcrypt('12345678'),
            'role' => 'admin',
        ]);
        User::create([
            'name' => 'Admin4',
            'email' => 'admin4@gmail.com',
            'contact_no' => '09123456789',
            'password' => bcrypt('12345678'),
            'role' => 'admin',
        ]);
        User::create([
            'name' => 'TEST GUARD',
            'email' => 'testguard@gmail.com',
            'contact_no' => '09123456789',
            'password' => bcrypt('12345678'),

            'role' => 'guard',
        ]);
        User::create([
            'name' => 'Guard1',
            'email' => 'guard1@gmail.com',
            'contact_no' => '0987654321',
            'password' => bcrypt('12345678'),

            'role' => 'guard',
        ]);
        User::create([
            'name' => 'Guard2',
            'email' => 'guard2@gmail.com',
            'contact_no' => '0987654123',
            'password' => bcrypt('12345678'),

            'role' => 'guard',
        ]);
        User::create([
            'name' => 'Guard3',
            'email' => 'guard3@gmail.com',
            'contact_no' => '0987654567',
            'password' => bcrypt('12345678'),

            'role' => 'guard',
        ]);
        User::create([
            'name' => 'Guard4',
            'email' => 'guard4@gmail.com',
            'contact_no' => '0987654876',
            'password' => bcrypt('12345678'),

            'role' => 'guard',
        ]);
        User::create([
            'name' => 'Resident1',
            'contact_no' => '0987654321',
            'plate_no' => 'ABC 123',
            'address' => 'BLK 456 PHASE 5 Apple Street',

            'role' => 'resident',
        ]);
        User::create([
            'name' => 'Resident2',
            'contact_no' => '0987654321',
            'plate_no' => 'CBA 897',
            'address' => 'BLK 675 PHASE 2 Banana Street',

            'role' => 'resident',
        ]);
        User::create([
            'name' => 'Resident3',
            'contact_no' => '0987654324',
            'plate_no' => 'QWH 943',
            'address' => 'BLK 23 PHASE 6 Durian Street',

            'role' => 'resident',
        ]);
        User::create([
            'name' => 'Resident4',
            'contact_no' => '0987894324',
            'plate_no' => 'KJL 345',
            'address' => 'BLK 192 PHASE 2 Grapes Street',

            'role' => 'resident',
        ]);
        User::create([
            'name' => 'Ticycle Driver1',
            'contact_no' => '09123456789',
            'plate_no' => 'TODA 567',

            'role' => 'driver',
        ]);
        User::create([
            'name' => 'Ticycle Driver2',
            'contact_no' => '0987656789',
            'plate_no' => 'TODA 143',

            'role' => 'driver',
        ]);
        User::create([
            'name' => 'Ticycle Driver3',
            'contact_no' => '0967856789',
            'plate_no' => 'TODA 986',

            'role' => 'driver',
        ]);
        User::create([
            'name' => 'Ticycle Driver4',
            'contact_no' => '0932156789',
            'plate_no' => 'TODA 150',

            'role' => 'driver',
        ]);
    }
}
