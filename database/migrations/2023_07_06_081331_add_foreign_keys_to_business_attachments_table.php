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
        Schema::table('business_attachments', function (Blueprint $table) {
            $table->foreign(['business_id'], 'fk_business_attachments_1')->references(['id'])->on('businesses')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['deleted_by'], 'fk_business_attachments_users')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['updated_by'], 'fk_business_attachments_users_1')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['created_by'], 'fk_business_attachments_users_2')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_attachments', function (Blueprint $table) {
            $table->dropForeign('fk_business_attachments_1');
            $table->dropForeign('fk_business_attachments_users');
            $table->dropForeign('fk_business_attachments_users_1');
            $table->dropForeign('fk_business_attachments_users_2');
        });
    }
};
