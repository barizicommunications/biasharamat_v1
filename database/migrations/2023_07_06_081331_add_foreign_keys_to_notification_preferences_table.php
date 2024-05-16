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
        Schema::table('notification_preferences', function (Blueprint $table) {
            $table->foreign(['user_id'], 'fk_notification_preferences_users')->references(['id'])->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['updated_by'], 'fk_notification_preferences_users_2')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['created_by'], 'fk_notification_preferences_users_created_by')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notification_preferences', function (Blueprint $table) {
            $table->dropForeign('fk_notification_preferences_users');
            $table->dropForeign('fk_notification_preferences_users_2');
            $table->dropForeign('fk_notification_preferences_users_created_by');
        });
    }
};
