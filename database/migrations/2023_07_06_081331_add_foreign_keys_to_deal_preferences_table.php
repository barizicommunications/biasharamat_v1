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
        Schema::table('deal_preferences', function (Blueprint $table) {
            $table->foreign(['created_by'], 'fk_deal_preferences_users_2')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['updated_by'], 'fk_deal_preferences_users_3')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['user_id'], 'fk_notification_preferences_users1')->references(['id'])->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deal_preferences', function (Blueprint $table) {
            $table->dropForeign('fk_deal_preferences_users_2');
            $table->dropForeign('fk_deal_preferences_users_3');
            $table->dropForeign('fk_notification_preferences_users1');
        });
    }
};
