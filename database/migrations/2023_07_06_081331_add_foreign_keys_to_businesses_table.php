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
        Schema::table('businesses', function (Blueprint $table) {
            $table->foreign(['legal_entity_id'], 'fk_businesses_legall_entities')->references(['id'])->on('legal_entities')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['location_id'], 'fk_businesses_locations')->references(['id'])->on('business_locations')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['user_id'], 'fk_businesses_users')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['updated_by'], 'fk_businesses_users_1')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['created_by'], 'fk_businesses_users_2')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('businesses', function (Blueprint $table) {
            $table->dropForeign('fk_businesses_legall_entities');
            $table->dropForeign('fk_businesses_locations');
            $table->dropForeign('fk_businesses_users');
            $table->dropForeign('fk_businesses_users_1');
            $table->dropForeign('fk_businesses_users_2');
        });
    }
};
