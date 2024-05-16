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
        Schema::create('businesses', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->string('name');
            $table->year('year_established');
            $table->json('industries');
            $table->bigInteger('location_id')->index('fk_businesses_locations_idx');
            $table->integer('country_id');
            $table->string('number_of_employees', 45);
            $table->integer('legal_entity_id')->index('fk_businesses_legall_entities_idx');
            $table->longText('description');
            $table->enum('visibility', ['private', 'public'])->default('private');
            $table->string('website_url', 100)->nullable();
            $table->longText('highlights');
            $table->double('monthly_sales');
            $table->string('yearly_sales', 100);
            $table->string('EBITDA', 100)->nullable();
            $table->longText('assets');
            $table->longText('liabilities');
            $table->string('physical_assets_value', 100);
            $table->boolean('receive_quotations')->nullable()->default(false);
            $table->timestamp('created_at')->useCurrent();
            $table->bigInteger('created_by')->index('fk_businesses_users_2_idx');
            $table->timestamp('updated_at')->nullable()->useCurrent();
            $table->bigInteger('updated_by')->nullable()->index('fk_businesses_users_1_idx');
            $table->softDeletes();
            $table->timestamp('approved_at')->nullable();
            $table->bigInteger('user_id')->index('fk_businesses_users');
            $table->enum('interest', ['full_sale', 'sale', 'loan', 'lease_assets']);
            $table->longText('loans')->nullable();
            $table->double('asking_price')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('businesses');
    }
};
