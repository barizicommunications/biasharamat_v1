<?php

namespace Database\Seeders;

use App\Models\InvestorProfile;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class InvestorProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            InvestorProfile::create([
                'user_id' => $i,
                'name' => "Investor $i",
                'email' => "investor$i@example.com",
                'mobile_number' => "0700" . rand(100000, 999999),
                'interested_in' => 'Technology',
                'buyer_role' => 'Investor',
                'buyer_interest' => 'Startups',
                'buyer_location_interest' => 'Nairobi',
                'investment_range' => '50000 - 500000',
                'current_location' => 'Nairobi, Kenya',
                'company_name' => "Investor Co. $i",
                'linkedin_profile' => "https://linkedin.com/in/investor$i",
                'website_link' => "https://investor$i.com",
                'business_factors' => 'Growth potential, market size',
                'about_company' => "Investor Co. $i specializes in early-stage investments.",
                'terms_of_engagement' => true,
                'active_business' => '2',
                'verification_status' => 'Pending',
                'reason_for_decline' => null,
                'display_contact_details' => false,
            ]);
        }
    }
}
