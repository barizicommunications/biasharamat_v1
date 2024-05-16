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
        Schema::create('deal_preferences', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->bigInteger('user_id')->nullable()->index('fk_notification_preferences_users_idx');
            $table->json('locations');
            $table->json('industries')->nullable();
            $table->string('deal_size', 200)->nullable();
            $table->string('created_at', 45)->nullable();
            $table->string('updated_at', 45)->nullable();
            $table->bigInteger('created_by')->nullable()->index('fk_deal_preferences_users_2_idx');
            $table->bigInteger('updated_by')->nullable()->index('fk_deal_preferences_users_3_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deal_preferences');
    }
};
