<?php

namespace Database\Seeders;

use App\Models\InvestorProfile;
use Illuminate\Database\Seeder;

class InvestorProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pdfs = [
            'documents/pdfs/sample1.pdf',
            'documents/pdfs/sample2.pdf',
            'documents/pdfs/sample3.pdf',
        ];

        $images = [
            'documents/images/image1.jpg',
            'documents/images/image2.jpg',
            'documents/images/image3.jpg',
        ];

        for ($i = 1; $i <= 5; $i++) {
            InvestorProfile::create([
                'user_id' => $i + 5, // Assuming user IDs 6 to 10 are for investors
                'name' => "Investor FirstName $i Investor LastName $i",
                'email' => "investor$i@example.com",
                'mobile_number' => "0701" . rand(100000, 999999),
                'display_contact_details' => (bool)rand(0, 1),
                'company_name' => "Investor Company $i",
                'current_location' => 'Nairobi, Kenya',
                'your_designation' => 'Investor',
                'company_industry' => 'Technology',
                'linkedin_profile' => "https://linkedin.com/in/investor$i",
                'website_link' => "https://investor$i.com",
                'about_company' => "Investor Company $i specializes in early-stage tech investments.",
                'business_factors' => 'Innovation, Scalability, Market Potential',
                'interested_in' => 'investing_in_a_business',
                'other_interest' => null,
                'buyer_role' => 'Corporate investor/buyer',
                'other_buyer_role' => null,
                'buyer_interest' => 'Technology',
                'buyer_location_interest' => 'Nairobi',
                'investment_range' => rand(100000, 5000000),
                'business_profile' => $pdfs[array_rand($pdfs)],
                'certificate_of_incorporation' => $pdfs[array_rand($pdfs)],
                'active_business' => rand(12000, 143999),
                'terms_of_engagement' => true,
                'verification_status' => 'Pending',
                'reason_for_decline' => null,
            ]);
        }
    }
}
