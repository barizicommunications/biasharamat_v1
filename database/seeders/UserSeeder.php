<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
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

        Log::info('Roles fetched successfully', [
            'sellerRole' => $sellerRole,
            'investorRole' => $investorRole,
            'adminRole' => $adminRole,
        ]);

        // Names for Business Sellers
        $sellerNames = [
            ['first_name' => 'Amara', 'last_name' => 'Smith'],
            ['first_name' => 'Liam', 'last_name' => 'Johnson'],
            ['first_name' => 'Noah', 'last_name' => 'Williams'],
            ['first_name' => 'Ava', 'last_name' => 'Brown'],
            ['first_name' => 'Mia', 'last_name' => 'Davis'],
        ];

        // Create test users for Business Sellers
        foreach ($sellerNames as $index => $seller) {
            $email = "seller" . ($index + 1) . "@example.com";
            $phone = '0700' . rand(100000, 999999);

            $user = User::create([
                'first_name' => $seller['first_name'],
                'last_name' => $seller['last_name'],
                'registration_type' => 'Business Seller',
                'email' => $email,
                'password' => bcrypt('password'),
                'phone' => $phone,
            ]);

            $user->assignRole($sellerRole);

            Log::info('Business Seller created', [
                'first_name' => $seller['first_name'],
                'last_name' => $seller['last_name'],
                'email' => $email,
                'phone' => $phone,
            ]);
        }

        // Names for Business Investors
        $investorNames = [
            ['first_name' => 'Ethan', 'last_name' => 'Miller'],
            ['first_name' => 'Sophia', 'last_name' => 'Wilson'],
            ['first_name' => 'James', 'last_name' => 'Moore'],
            ['first_name' => 'Isabella', 'last_name' => 'Taylor'],
            ['first_name' => 'Lucas', 'last_name' => 'Anderson'],
        ];

        // Create test users for Business Investors
        foreach ($investorNames as $index => $investor) {
            $email = "investor" . ($index + 1) . "@example.com";
            $phone = '0701' . rand(100000, 999999);

            $user = User::create([
                'first_name' => $investor['first_name'],
                'last_name' => $investor['last_name'],
                'registration_type' => 'Business Investor',
                'email' => $email,
                'password' => bcrypt('password'),
                'phone' => $phone,
            ]);

            $user->assignRole($investorRole);

            Log::info('Business Investor created', [
                'first_name' => $investor['first_name'],
                'last_name' => $investor['last_name'],
                'email' => $email,
                'phone' => $phone,
            ]);
        }

        // Create an admin user
        $adminEmail = 'admin@example.com';
        $adminPhone = '0712345678';

        $admin = User::create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'registration_type' => 'Admin',
            'email' => $adminEmail,
            'password' => bcrypt('password'),
            'phone' => $adminPhone,
        ]);

        $admin->assignRole($adminRole);

        Log::info('Admin user created', [
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => $adminEmail,
            'phone' => $adminPhone,
        ]);
    }
}
