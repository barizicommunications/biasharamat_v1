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
        Schema::table('business_locations', function (Blueprint $table) {
            $table->foreign(['county_id'], 'fk_locations_counties')->references(['id'])->on('counties')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['country_id'], 'fk_locations_countries')->references(['id'])->on('countries')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_locations', function (Blueprint $table) {
            $table->dropForeign('fk_locations_counties');
            $table->dropForeign('fk_locations_countries');
        });
    }
};
