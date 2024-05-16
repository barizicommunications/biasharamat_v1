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
        Schema::table('billing_preferences', function (Blueprint $table) {
            $table->foreign(['user_id'], 'fk_billing_preferences_users')->references(['id'])->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['created_by'], 'fk_billing_preferences_users_1')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['updated_by'], 'fk_billing_preferences_users_2')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('billing_preferences', function (Blueprint $table) {
            $table->dropForeign('fk_billing_preferences_users');
            $table->dropForeign('fk_billing_preferences_users_1');
            $table->dropForeign('fk_billing_preferences_users_2');
        });
    }
};
