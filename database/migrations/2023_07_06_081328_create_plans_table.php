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
        Schema::create('plans', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('name');
            $table->string('price', 45)->nullable();
            $table->string('description', 45)->nullable();
            $table->string('created_at', 45)->nullable();
            $table->string('created_by', 45)->nullable();
            $table->string('updated_by', 45)->nullable();
            $table->string('updated_at', 45)->nullable();
            $table->string('deleted_at', 45)->nullable();
            $table->string('deleted_by', 45)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plans');
    }
};
