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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('paid_by')->nullable();
            $table->string('payment_method')->default('MpesaKE');
            $table->decimal('amount', 10, 2);
            $table->timestamp('created_date')->useCurrent();
            $table->string('confirmation_code');
            $table->uuid('order_tracking_id');
            $table->string('payment_status_description');
            $table->text('description')->nullable();
            $table->string('message');
            $table->string('payment_account');
            $table->string('call_back_url');
            $table->integer('status_code');
            $table->string('merchant_reference');
            $table->string('payment_status_code')->nullable();
            $table->string('currency')->default('KES');
            $table->json('error')->nullable();
            $table->string('status')->default('200');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
