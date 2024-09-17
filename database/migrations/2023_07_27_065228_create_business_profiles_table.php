<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('business_profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique();
            $table->string('name');
            $table->string('company_name');
            $table->string('mobile_number');
            $table->string('email')->unique();
            $table->string('display_company_details')->nullable();
            $table->string('display_contact_details')->nullable();
            $table->enum('seller_role', ['Director', 'Adviser', 'Shareholder', 'Other']);
            $table->string('seller_interest');
            $table->decimal('tentative_selling_price', 15, 2)->nullable(); // Numeric field for selling price
            $table->text('reason_for_sale')->nullable(); // Text field for reason for sale
            $table->decimal('maximum_stake', 5, 2)->nullable(); // Percentage stake
            $table->decimal('investment_amount', 15, 2)->nullable(); // Investment amount
            $table->text('reason_for_investment')->nullable(); // Text field for investment reason
            $table->decimal('value_of_physical_assets', 15, 2)->nullable(); // Value of assets
            $table->decimal('asset_selling_price', 15, 2)->nullable(); // Price of selling/leasing assets
            $table->text('reason_for_selling_assets')->nullable(); // Reason for selling assets
            $table->decimal('colateral_value', 15, 2)->nullable(); // Collateral value
            $table->decimal('loan_amount', 15, 2)->nullable(); // Loan amount
            $table->decimal('yearly_interest_pay', 15, 2)->nullable(); // Maximum yearly investment
            $table->integer('years_repay_loan')->nullable(); // Years to repay loan
            $table->text('reason_for_seeking_loan')->nullable(); // Reason for seeking loan
            $table->string('business_start_date');
            $table->string('business_industry');
            $table->string('country');
            $table->string('city');
            $table->string('county');
            $table->integer('number_employees');
            $table->string('business_legal_entity');
            $table->string('website_link');
            $table->text('business_description');
            $table->text('facility_description');
            $table->string('business_funds');
            $table->string('number_shareholders');
            $table->string('monthly_turnover');
            $table->string('yearly_turnover');
            $table->string('profit_margin');
            $table->string('tangible_assets');
            $table->string('liabilities');
            $table->string('physical_assets');
            $table->string('interested_in_quotations')->nullable();
            $table->json('business_photos')->nullable();
            $table->string('business_profile')->nullable();  // Stores the path to the PDF
            $table->string('kra_pin')->nullable();  // Stores the path to the KRA pin PDF
            $table->string('certificate_of_incorporation')->nullable(); // Certificate of Incorporation
            $table->string('valuation_report')->nullable();  // Stores the path to the valuation report PDF
            $table->string('other_seller_role')->nullable();
            $table->string('active_business')->nullable();
            $table->string('finders_fee')->nullable();
            $table->text('reason_for_decline')->nullable();
            $table->string('verification_status')->default('Pending')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_profiles');
    }
};
