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

        $users = User::where('registration_type', 'Business Seller')->get();

        foreach ($users as $index => $user) {
            BusinessProfile::create([
                'user_id' => $user->id,
                'email' => $user->email,
                'name' => "{$user->first_name} {$user->last_name}",
                'company_name' => $companyNames[$index % count($companyNames)],
                'mobile_number' => $user->phone,
                'status' => 'pending',
                'verification_status' => 'Pending',
                'finders_fee' => (bool)rand(0, 1),
                'documents' => json_encode([
                    'business_profile' => $pdfs[array_rand($pdfs)],
                    'kra_pin' => $pdfs[array_rand($pdfs)],
                    'certificate_of_incorporation' => $pdfs[array_rand($pdfs)],
                    'valuation_report' => $pdfs[array_rand($pdfs)],
                    'number_shareholders' => $pdfs[array_rand($pdfs)],
                    'tangible_assets' => $pdfs[array_rand($pdfs)],
                    'liabilities' => $pdfs[array_rand($pdfs)],
                    'business_photos' => [
                        $images[array_rand($images)],
                        $images[array_rand($images)],
                    ],
                ]),
                'business_industry' => 'Retail',
                'business_start_date' => now()->subYears(rand(1, 10))->format('Y-m-d'),
                'tentative_selling_price' => rand(50000, 1000000),
                'maximum_stake' => rand(10, 100),
                'active_business' => rand(12000, 143999),
                'plan_type' => rand(0, 1) ? 'monthly' : 'yearly',
                'application_data' => json_encode([
                    'seller_role' => 'Shareholder',
                    'seller_interest' => 'Sale of shares',
                    'reason_for_sale' => 'Business diversification',
                    'business_funds' => 'Company reserves',
                    'display_contact_details' => (bool)rand(0, 1),
                    'display_company_details' => (bool)rand(0, 1),
                ]),
            ]);
        }
    }
}
