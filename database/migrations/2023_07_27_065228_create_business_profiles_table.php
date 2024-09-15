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
            $table->date('business_start_date');
            $table->string('business_industry');
            $table->string('country');
            $table->string('city');
            $table->string('county');
            $table->integer('number_employees');
            $table->string('business_legal_entity');
            $table->string('website_link');
            $table->text('business_description');
            $table->text('product_services');
            $table->text('business_highlights');
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
            $table->string('business_photos');
            $table->string('information_memorandum');
            $table->string('financial_report');
            $table->string('valuation_worksheets');
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
