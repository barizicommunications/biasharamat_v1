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
        Schema::create('business_locations', function (Blueprint $table) {
            $table->bigInteger('id', true)->unique('id_UNIQUE');
            $table->integer('country_id')->index('fk_locations_1_idx');
            $table->string('city', 100);
            $table->string('town', 100);
            $table->integer('county_id')->nullable()->index('fk_locations_counties_idx');
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->bigInteger('created_by')->nullable();
            $table->timestamp('updated_at')->nullable()->useCurrent();
            $table->bigInteger('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('business_locations');
    }
};
