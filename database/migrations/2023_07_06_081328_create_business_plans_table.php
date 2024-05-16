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
        Schema::create('business_plans', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->bigInteger('business_id')->index('fk_business_plans_business_idx');
            $table->integer('plan_id')->index('fk_business_plans_plan_idx');
            $table->timestamps();
            $table->timestamp('expiry_at')->nullable();
            $table->integer('grace_period')->nullable();
            $table->bigInteger('payment_id')->index('fk_business_plans_payments_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('business_plans');
    }
};
