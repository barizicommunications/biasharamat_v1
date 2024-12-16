<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\BusinessProfile;
use Illuminate\Database\Seeder;

class BusinessProfileSeeder extends Seeder
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

        $companyNames = [
            'NovaTech Solutions',
            'Pioneer Traders',
            'Visionary Enterprises',
            'Spark Industries',
            'Momentum Retail',
        ];

        $industries = [
            'Retail',
            'Technology',
            'Healthcare',
            'Finance',
            'Manufacturing',
        ];

        $descriptions = [
            'A leading provider of innovative solutions.',
            'Experts in trading and supply chain management.',
            'Focused on delivering visionary business strategies.',
            'Industrial leaders in manufacturing and innovation.',
            'Pioneers in retail and customer service.',
        ];

        $users = User::where('registration_type', 'Business Seller')->get();

        foreach ($users as $index => $user) {
            $businessDocuments = [
                'business_profile' => $pdfs[array_rand($pdfs)],
                'kra_pin' => $pdfs[array_rand($pdfs)],
                'certificate_of_incorporation' => $pdfs[array_rand($pdfs)],
                'valuation_report' => $pdfs[array_rand($pdfs)],
                'business_photos' => [
                    $images[array_rand($images)],
                    $images[array_rand($images)],
                ],
                'number_shareholders' => $pdfs[array_rand($pdfs)],
                'tangible_assets' => $pdfs[array_rand($pdfs)],
                'liabilities' => $pdfs[array_rand($pdfs)],
            ];

            $applicationData = [
                'name' => "{$user->first_name} {$user->last_name}",
                'company_name' => $companyNames[$index % count($companyNames)],
                'mobile_number' => $user->phone,
                'email' => $user->email,
                'display_company_details' => (bool)rand(0, 1),
                'seller_role' => 'Director',
                'seller_interest' => 'Sale of shares',
                'tentative_selling_price' => (string)rand(50000, 1000000),
                'reason_for_sale' => 'Business diversification',
                'business_start_date' => now()->subYears(rand(1, 10))->format('Y-m-d'),
                'business_industry' => $industries[$index % count($industries)],
                'country' => 'Belgium',
                'city' => 'Antwerp',
                'town' => 'Downtown',
                'number_employees' => (string)rand(10, 500),
                'business_legal_entity' => 'Sole proprietorship/sole trader',
                'website_link' => 'https://www.example.com',
                'business_description' => $descriptions[$index % count($descriptions)],
                'facility_description' => 'State-of-the-art facilities with modern equipment.',
                'business_funds' => 'Company reserves',
                'monthly_turnover' => (string)rand(10000, 50000),
                'yearly_turnover' => (string)rand(100000, 500000),
                'profit_margin' => (string)rand(10, 50),
                'physical_assets' => (string)rand(10000, 100000),
            ];

            BusinessProfile::create([
                'user_id' => $user->id,
                'email' => $user->email,
                'status' => 'pending',
                'verification_status' => 'Pending',
                'finders_fee' => (bool)rand(0, 1),
                'documents' => $businessDocuments,
                'business_industry' => $industries[$index % count($industries)],
                'business_start_date' => now()->subYears(rand(1, 10))->format('Y-m-d'),
                'tentative_selling_price' => rand(50000, 1000000),
                'maximum_stake' => rand(10, 100),
                'active_business' => rand(12000, 143999),
                'plan_type' => rand(0, 1) ? 'monthly' : 'yearly',
                'application_data' => $applicationData,
            ]);
        }
    }
}
