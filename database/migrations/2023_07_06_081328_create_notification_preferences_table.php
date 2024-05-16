<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification_preferences', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->bigInteger('user_id')->nullable()->index('fk_notification_preferences_users_idx');
            $table->enum('important_communication', ['subscribed', 'unsubscribed'])->default('subscribed');
            $table->enum('business_proposals', ['real_time', 'daily', 'weekly', 'fortnightly', 'monthly', 'quarterly', 'half_yearly', 'yearly', 'unsubscribed'])->nullable()->default('real_time');
            $table->enum('new_opportunity_notifications', ['real_time', 'daily', 'weekly', 'fortnightly', 'monthly', 'quarterly', 'half_yearly', 'yearly', 'unsubscribed'])->nullable()->default('weekly');
            $table->string('created_at', 45)->nullable();
            $table->string('updated_at', 45)->nullable();
            $table->bigInteger('created_by')->nullable()->index('fk_notification_preferences_users_created_by_idx');
            $table->bigInteger('updated_by')->nullable()->index('fk_notification_preferences_users_2_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notification_preferences');
    }
};
