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
        Schema::table('plan_benefits', function (Blueprint $table) {
            $table->foreign(['plan_id'], 'fk_plan_benefits_plans')->references(['id'])->on('plans')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('plan_benefits', function (Blueprint $table) {
            $table->dropForeign('fk_plan_benefits_plans');
        });
    }
};
