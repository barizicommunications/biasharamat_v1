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
        Schema::create('investor_profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique();
            $table->string('name', 255);
            $table->string('email', 255);
            $table->string('mobile_number', 15);
            $table->string('interested_in');
            $table->string('buyer_role');
            $table->string('buyer_interest');
            $table->string('buyer_location_interest');
            $table->string('investment_range',255);
            $table->string('current_location', 255);
            $table->string('company_name', 255);
            $table->string('other_interest', 255)->nullable();
            $table->string('linkedin_profile', 255);
            $table->string('website_link', 255);
            $table->string('business_factors', 1000);
            $table->string('about_company', 1000);
            $table->boolean('terms_of_engagement')->default(false);
            $table->string('active_business')->nullable();
            $table->string('verification_status')->default('Pending')->nullable();
            $table->text('reason_for_decline')->nullable();
            $table->boolean('display_contact_details')->default(false);
            $table->string('your_designation')->nullable();
            $table->string('company_industry')->nullable();
            $table->string('other_buyer_role')->nullable();
            $table->string('business_profile')->nullable();
            $table->string('certificate_of_incorporation')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investor_profiles');
    }
};
