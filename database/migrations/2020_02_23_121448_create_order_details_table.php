<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrderDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('order_details', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('order_id');
			$table->integer('product_id');
			$table->integer('seller_id')->nullable();
			$table->integer('supplier_id')->nullable();
            $table->string('product_name_en', 191)->nullable();
            $table->string('product_name_ar', 191)->nullable();
			$table->integer('qty')->nullable();
			$table->integer('unit_price')->nullable();
			$table->float('tax')->default(0.00);
			$table->float('discount')->default(0.00);
			$table->float('sub_total')->nullable();
			$table->float('total_tax')->nullable();
			$table->float('total_discount')->nullable();
            $table->string('discount_format')->default('flat');
            $table->string('tax_format')->default('flat');
            $table->text('variation')->nullable();
			$table->bigInteger('variation_id')->nullable();
			$table->float('commission')->default(0.00);
			$table->string('payment_status', 10)->default('unpaid');
			$table->string('delivery_status', 20)->nullable()->default(1);
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
		Schema::drop('order_details');
	}

}
