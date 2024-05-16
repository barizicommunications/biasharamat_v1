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
        Schema::table('payments_requests', function (Blueprint $table) {
            $table->foreign(['checkout_request_id'], 'fk_payments_requests_payments')->references(['checkout_request_id'])->on('payments')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payments_requests', function (Blueprint $table) {
            $table->dropForeign('fk_payments_requests_payments');
        });
    }
};
