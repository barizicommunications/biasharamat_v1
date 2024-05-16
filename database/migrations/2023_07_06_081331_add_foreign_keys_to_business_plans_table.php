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
        Schema::table('business_plans', function (Blueprint $table) {
            $table->foreign(['business_id'], 'fk_business_plans_business')->references(['id'])->on('businesses')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['payment_id'], 'fk_business_plans_payments')->references(['id'])->on('payments')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['plan_id'], 'fk_business_plans_plan')->references(['id'])->on('plans')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_plans', function (Blueprint $table) {
            $table->dropForeign('fk_business_plans_business');
            $table->dropForeign('fk_business_plans_payments');
            $table->dropForeign('fk_business_plans_plan');
        });
    }
};
