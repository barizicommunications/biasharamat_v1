<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          // Define roles
          $roles = ['Business Seller', 'Business Investor', 'Admin'];

          foreach ($roles as $roleName) {
              Role::firstOrCreate(['name' => $roleName]);
          }
    }
}
