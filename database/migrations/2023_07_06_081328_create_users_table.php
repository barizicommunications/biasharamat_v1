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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('last_name', 45);
            $table->string('first_name', 45);
            $table->string('registration_type')->default('Business Seller')->nullable();
            $table->string('email')->index('email_idx')->unique();
            $table->string('password', 200);
            $table->string('position', 50)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone', 20)->index('phone_idx')->nullable();
            $table->text('profile_photo_url')->nullable();

            $table->unique(['email'], 'email_UNIQUE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
