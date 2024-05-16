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
        Schema::create('payments_requests', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('business_id');
            $table->double('amount');
            $table->bigInteger('user_id')->nullable()->comment('the user that paid, not the user who the belongs to.
');
            $table->timestamp('created_at');
            $table->timestamp('updated_at')->nullable();
            $table->softDeletes();
            $table->bigInteger('deleted_by')->nullable();
            $table->bigInteger('updated_by')->nullable();
            $table->string('checkout_request_id', 200)->nullable()->index('checkout_request_id');
            $table->boolean('is_successful')->nullable()->default(false);
            $table->string('payment_platform', 45)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments_requests');
    }
};
