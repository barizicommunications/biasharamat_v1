<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Fetch roles
        $sellerRole = Role::where('name', 'Business Seller')->first();
        $investorRole = Role::where('name', 'Business Investor')->first();
        $adminRole = Role::where('name', 'Admin')->first();

        // Create test users for Business Seller
        for ($i = 1; $i <= 5; $i++) {
            $user = User::create([
                'first_name' => "Seller FirstName $i",
                'last_name' => "Seller LastName $i",
                'registration_type' => 'Business Seller',
                'email' => "seller$i@example.com",
                'password' => bcrypt('password'),
                'phone' => '0700' . rand(100000, 999999),
            ]);
            $user->assignRole($sellerRole);
        }

        // Create test users for Business Investor
        for ($i = 1; $i <= 5; $i++) {
            $user = User::create([
                'first_name' => "Investor FirstName $i",
                'last_name' => "Investor LastName $i",
                'registration_type' => 'Business Investor',
                'email' => "investor$i@example.com",
                'password' => bcrypt('password'),
                'phone' => '0701' . rand(100000, 999999),
            ]);
            $user->assignRole($investorRole);
        }

        // Create an admin user
        $admin = User::create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'registration_type' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'phone' => '0712345678',
        ]);
        $admin->assignRole($adminRole);
    }
}
