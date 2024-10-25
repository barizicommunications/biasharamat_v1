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
            $table->foreignId('user_id')->unique()->constrained('users')->onDelete('cascade'); // Foreign key to users table
            $table->string('email')->unique(); // Index for email to allow easy lookups
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending'); // Status of the seller's application
            $table->enum('verification_status', ['Pending', 'Approved', 'Declined'])->default('Pending'); // Verification status

            // Add the finders_fee field
            $table->boolean('finders_fee')->default(false); // To store the user's agreement to pay a finder's fee

            // Store all file upload paths in the documents field
            $table->json('documents')->nullable(); // JSON field for storing file paths (for all file uploads)

            // Separate indexed fields for quick access and filtering
            $table->string('business_industry')->nullable(); // For industry-based filtering
            $table->string('business_start_date')->nullable(); // Quick access for business age
            $table->decimal('tentative_selling_price', 15, 2)->nullable(); // Quick access to selling price
            $table->decimal('maximum_stake', 5, 2)->nullable(); // For stake-based filtering

            // Plan details
            $table->integer('active_business')->nullable(); // Store the price value of the plan
            $table->enum('plan_type', ['monthly', 'yearly'])->nullable(); // Store the type of plan (monthly, yearly)

            // Store non-file data in JSON format
            $table->json('application_data'); // JSON field for form data (non-file fields)

            // Timestamps
            $table->timestamps(); // Created at and updated at fields
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
