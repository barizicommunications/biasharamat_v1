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
        Schema::create('business_attachments', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('name');
            $table->text('url');
            $table->timestamp('created_at');
            $table->timestamp('updated_at')->nullable();
            $table->bigInteger('created_by')->index('fk_business_attachments_users_2_idx');
            $table->bigInteger('updated_by')->nullable()->index('fk_business_attachments_users_1_idx');
            $table->softDeletes();
            $table->bigInteger('deleted_by')->nullable()->index('fk_business_photos_users_idx');
            $table->bigInteger('business_id')->nullable()->index('fk_business_photos_1_idx');
            $table->enum('type', ['photo', 'business_document', 'business_proof']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('business_attachments');
    }
};
