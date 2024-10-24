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
            $table->foreignId('user_id')->unique()->constrained('users')->onDelete('cascade');
            $table->string('email')->unique();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->enum('verification_status', ['Pending', 'Approved', 'Declined'])->default('Pending');

            // Add active_business and plan_type fields
            $table->integer('active_business')->nullable(); // Store the price value of the plan
            $table->enum('plan_type', ['monthly', 'yearly'])->nullable(); // Store the type of plan (monthly, yearly)

            $table->json('application_data');
            $table->json('documents')->nullable();
            $table->string('business_industry')->nullable();
            $table->string('business_start_date')->nullable();
            $table->decimal('tentative_selling_price', 15, 2)->nullable();
            $table->decimal('maximum_stake', 5, 2)->nullable();
            $table->timestamps();
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
