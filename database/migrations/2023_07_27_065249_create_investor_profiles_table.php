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
            $table->enum('interested_in', [
                'acquiring_business',
                'investing_in_a_business',
                'lending_to_a_business',
                'buying_property_plant_machinery',
                'taking_up_franchise'
            ]);
            $table->enum('buyer_role', ['Individual investor/buyer', 'Corporate investor/buyer']);
            $table->enum('buyer_interest', ['Select all', 'Education', 'Technology', 'Building construction and maintenance']);
            $table->enum('buyer_location_interest', ['Nairobi', 'Mombasa', 'Kisumu', 'Eldoret', 'Nakuru']);
            $table->decimal('investment_range', 15, 2)->default(0);
            $table->string('current_location', 255);
            $table->string('company_name', 255);
            $table->string('linkedin_profile', 255);
            $table->string('website_link', 255);
            $table->string('business_factors', 1000);
            $table->string('about_company', 1000);
            $table->string('corporate_profile');
            $table->string('company_logo');
            $table->string('proof_of_business');
            $table->string('terms_of_engagement')->default('off');
            $table->enum('active_business', ['active business', 'premium plan', 'yearly plan']);
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
