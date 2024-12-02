<?php

namespace Database\Seeders;

use App\Models\BusinessProfile;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BusinessProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            BusinessProfile::create([
                'user_id' => $i,
                'email' => "business$i@example.com",
                'name' => "Business Owner $i", // Adding name field
                'company_name' => "Company $i", // Adding company_name field
                'mobile_number' => "0700" . rand(100000, 999999), // Adding mobile_number field
                'status' => 'pending',
                'verification_status' => 'Pending',
                'finders_fee' => false,
                'documents' => json_encode(['document1.pdf', 'document2.jpg']),
                'business_industry' => 'Retail',
                'business_start_date' => now()->subYears(rand(1, 10))->format('Y-m-d'),
                'tentative_selling_price' => rand(50000, 1000000),
                'maximum_stake' => rand(10, 100),
                'active_business' => rand(1, 5),
                'plan_type' => 'monthly',
                'application_data' => json_encode(['key' => 'value']),
            ]);
        }
    }
}
