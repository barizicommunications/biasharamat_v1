<?php

namespace Database\Seeders;

use App\Models\User;
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

        $users = User::where('registration_type', 'Business Investor')->get();

        foreach ($users as $user) {
            InvestorProfile::create([
                'user_id' => $user->id,
                'name' => "{$user->first_name} {$user->last_name}",
                'email' => $user->email,
                'mobile_number' => $user->phone,
                'display_contact_details' => (bool)rand(0, 1),
                'company_name' => "{$user->last_name} Capital",
                'current_location' => 'Nairobi, Kenya',
                'your_designation' => 'Investor',
                'company_industry' => 'Technology',
                'linkedin_profile' => "https://linkedin.com/in/{$user->first_name}{$user->last_name}",
                'website_link' => "https://{$user->last_name}capital.com",
                'about_company' => "{$user->last_name} Capital focuses on early-stage tech investments.",
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
