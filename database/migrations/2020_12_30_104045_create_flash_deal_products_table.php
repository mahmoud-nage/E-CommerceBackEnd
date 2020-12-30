<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlashDealProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flash_deal_products', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('flash_deal_id');
            $table->integer('product_id');
            $table->integer('country_id');
            $table->integer('amount')->default(0);
            $table->double('discount', 8, 2)->nullable()->default(0.00);
            $table->tinyInteger('discount_type')->default(0)->comment('0 > amount, 1 > percentage');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flash_deal_products');
    }
}
