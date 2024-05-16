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
        Schema::table('business_shareholders', function (Blueprint $table) {
            $table->foreign(['business_id'], 'fk_business_shareholders_business')->references(['id'])->on('businesses')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_shareholders', function (Blueprint $table) {
            $table->dropForeign('fk_business_shareholders_business');
        });
    }
};
