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
        Schema::create('billing_preferences', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->bigInteger('user_id')->nullable()->index('fk_notification_preferences_users_idx');
            $table->string('name', 100)->default('subscribed');
            $table->string('phone', 20)->nullable()->default('real_time');
            $table->string('location', 200)->nullable()->default('weekly');
            $table->string('created_at', 45)->nullable();
            $table->string('updated_at', 45)->nullable();
            $table->bigInteger('created_by')->nullable()->index('fk_billing_preferences_users_1_idx');
            $table->bigInteger('updated_by')->nullable()->index('fk_billing_preferences_users_2_idx');
            $table->string('timezone', 100)->nullable();
            $table->string('company_name', 100)->nullable();
            $table->string('designation', 100)->nullable();
            $table->text('address')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('billing_preferences');
    }
};
