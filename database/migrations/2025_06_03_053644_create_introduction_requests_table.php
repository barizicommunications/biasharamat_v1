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
        Schema::create('introduction_requests', function (Blueprint $table) {
            $table->id();

            // Requester information
            $table->foreignId('requester_id')->constrained('users')->onDelete('cascade');
            $table->string('requester_name');
            $table->string('requester_email');
            $table->string('requester_phone');
            $table->string('requester_company')->nullable();

            // Target information
            $table->enum('target_type', ['business', 'investor']);
            $table->unsignedBigInteger('target_id'); // ID of BusinessProfile or InvestorProfile
            $table->foreignId('target_user_id')->constrained('users')->onDelete('cascade'); // Target user ID

            // Request details
            $table->enum('introduction_purpose', [
                'investment_opportunity',
                'business_acquisition',
                'partnership',
                'financing',
                'asset_purchase',
                'other'
            ]);
            $table->text('message');
            $table->enum('budget_range', [
                'under_1m',
                '1m_5m',
                '5m_10m',
                '10m_50m',
                '50m_100m',
                'over_100m'
            ])->nullable();

            // Request status and processing
            $table->enum('status', ['pending', 'approved', 'rejected', 'completed'])->default('pending');
            $table->decimal('service_fee', 10, 2)->default(2500.00);
            $table->enum('payment_status', ['unpaid', 'paid', 'refunded'])->default('unpaid');

            // Review information
            $table->text('rejection_reason')->nullable();
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('reviewed_at')->nullable();

            // Additional tracking
            $table->timestamp('introduction_sent_at')->nullable();
            $table->timestamp('payment_received_at')->nullable();

            $table->timestamps();

            // Indexes for performance
            $table->index(['requester_id', 'status']);
            $table->index(['target_user_id', 'status']);
            $table->index(['target_type', 'target_id']);
            $table->index('status');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('introduction_requests');
    }
};