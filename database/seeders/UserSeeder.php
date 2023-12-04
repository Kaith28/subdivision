<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create company
        $company = Company::create([
            "name" => "Sample Company"
        ]);

        // Create admin account
        User::create([
            'company_id' => $company->id,
            'name' => 'TEST owner',
            'email' => 'testowner@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'owner',
        ]);

        User::create([
            'company_id' => $company->id,
            'name' => 'TEST ADMIN',
            'email' => 'testadmin@gmail.com',
            'contact_no' => '09123456789',
            'password' => bcrypt('12345678'),
            'role' => 'admin',
        ]);

        User::create([
            'company_id' => $company->id,
            'name' => 'TEST GUARD',
            'email' => 'testguard@gmail.com',
            'contact_no' => '09123456789',
            'password' => bcrypt('12345678'),
            'role' => 'guard',
        ]);

        User::create([
            'company_id' => $company->id,
            'name' => 'Resident1',
            'contact_no' => '0987654321',
            'plate_no' => 'ABC 123',
            'address' => 'BLK 456 PHASE 5 Apple Street',
            'role' => 'resident',
        ]);

        User::create([
            'company_id' => $company->id,
            'name' => 'Resident2',
            'contact_no' => '0987654321',
            'plate_no' => 'CBA 897',
            'address' => 'BLK 675 PHASE 2 Banana Street',
            'role' => 'resident',
        ]);

        User::create([
            'company_id' => $company->id,
            'name' => 'Ticycle Driver1',
            'contact_no' => '09123456789',
            'plate_no' => 'TODA 567',
            'role' => 'driver',
        ]);

        User::create([
            'company_id' => $company->id,
            'name' => 'Ticycle Driver2',
            'contact_no' => '0987656789',
            'plate_no' => 'TODA 143',

            'role' => 'driver',
        ]);
    }
}
