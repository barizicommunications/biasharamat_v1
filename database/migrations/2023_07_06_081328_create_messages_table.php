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
        Schema::create('messages', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('sender_id')->nullable()->index('fk_bookmarks_users_idx');
            $table->timestamps();
            $table->bigInteger('receiver_id')->nullable()->index('fk_messages_users_1_idx');
            $table->text('content')->nullable();
            $table->timestamp('read_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
};
