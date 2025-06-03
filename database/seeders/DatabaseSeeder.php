<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Blog;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\BusinessProfileSeeder;
use Database\Seeders\InvestorProfileSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin Role if not exists
        $role = Role::firstOrCreate(['name' => 'Admin']);

        // Create Admin User
        $user = User::firstOrCreate([
            'email' => 'admin@gmail.com',
        ], [
            'first_name' => 'System',
            'last_name' => 'Admin',
            'registration_type' => 'Admin',
            'password' => Hash::make('password'),
        ]);

        // Assign Admin Role
        if (!$user->hasRole('Admin')) {
            $user->assignRole($role);
        }

        // Call other seeders
        $this->call([
            RoleSeeder::class,              // Step 1: Create roles for sellers, investors, etc.
            UserSeeder::class,              // Step 2: Seed users for sellers and investors
            // BusinessProfileSeeder::class,   // Step 3: Seed business profiles
            // InvestorProfileSeeder::class,   // Step 4: Seed investor profiles
        ]);
    }
}
