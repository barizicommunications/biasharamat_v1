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
        Schema::table('bookmarks', function (Blueprint $table) {
            $table->foreign(['business_id'], 'fk_bookmarks_businesses')->references(['id'])->on('businesses')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['user_id'], 'fk_bookmarks_users')->references(['id'])->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bookmarks', function (Blueprint $table) {
            $table->dropForeign('fk_bookmarks_businesses');
            $table->dropForeign('fk_bookmarks_users');
        });
    }
};
