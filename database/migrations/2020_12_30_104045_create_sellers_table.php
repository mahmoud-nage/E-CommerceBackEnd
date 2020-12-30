<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sellers', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('vodafone_status')->default(0);
            $table->integer('vodafone_number')->nullable()->default(0);
            $table->integer('postal_status')->default(0);
            $table->integer('postal_national_id')->default(0);
            $table->string('postal_client_name')->nullable();
            $table->string('bank_account_status')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_account_username')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->string('bank_branch')->nullable();
            $table->string('docid')->nullable();
            $table->string('SSN')->nullable();
            $table->double('balance')->default(0);
            $table->double('all_sales')->default(0);
            $table->integer('countProducts')->default(0);
            $table->integer('countCategory')->default(0);
            $table->integer('countBrand')->default(0);
            $table->integer('countPendingOrders')->default(0);
            $table->integer('countDeliveredOrders')->default(0);
            $table->integer('rating')->default(0);
            $table->integer('countRateRequest')->default(0);
            $table->string('name_ar', 191)->nullable();
            $table->string('name_en', 191);
            $table->string('logo', 191)->nullable();
            $table->text('sliders')->nullable();
            $table->string('address_ar', 191)->nullable();
            $table->string('address_en', 191)->nullable();
            $table->string('desc_ar', 191)->nullable();
            $table->string('desc_en', 191)->nullable();
            $table->string('facebook', 191)->nullable();
            $table->string('google', 191)->nullable();
            $table->string('twitter', 191)->nullable();
            $table->string('youtube', 191)->nullable();
            $table->string('slug', 191)->nullable();
            $table->string('meta_title', 191)->nullable();
            $table->text('meta_description')->nullable();
            $table->string('type')->default('admin')->comment('admin, seller');
            $table->tinyInteger('is_blocked')->default(0);
            $table->tinyInteger('active')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sellers');
    }
}
