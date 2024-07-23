<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Blog;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Blog::factory(34)->create();

        $user = User::create([
            'first_name' => "System",
            'last_name' => "Admin",
            'email' => "admin@gmail.com",
            'registration_type' => "Admin",
            'password' => Hash::make("password"),
        ]);






        $role = Role::where('name', "Admin")->first(); // Find the first role matching the name

        if (!$role) {
            // Create the role if it doesn't exist
            $role = Role::create(['name' => "Admin"]);
        }

        $user->assignRole($role);
    }
}
