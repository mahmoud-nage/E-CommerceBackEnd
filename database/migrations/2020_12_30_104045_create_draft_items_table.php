<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDraftItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('draft_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('draft_id');
            $table->integer('product_id');
            $table->integer('seller_id')->nullable();
            $table->integer('supplier_id')->nullable();
            $table->string('product_name_en', 191)->nullable();
            $table->string('product_name_ar', 191)->nullable();
            $table->integer('qty')->nullable();
            $table->integer('unit_price')->nullable();
            $table->double('tax', 8, 2)->default(0.00);
            $table->double('discount', 8, 2)->default(0.00);
            $table->double('sub_total', 8, 2)->nullable();
            $table->double('total_tax', 8, 2)->nullable();
            $table->double('total_discount', 8, 2)->nullable();
            $table->string('discount_format')->default('flat');
            $table->string('tax_format')->default('flat');
            $table->text('variation')->nullable();
            $table->bigInteger('variation_id')->nullable();
            $table->double('commission', 8, 2)->default(0.00);
            $table->string('payment_status', 10)->default('unpaid');
            $table->string('delivery_status', 20)->nullable()->default('1');
            $table->string('type')->nullable()->comment('pos, online');
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
        Schema::dropIfExists('draft_items');
    }
}
