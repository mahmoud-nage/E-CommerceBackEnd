<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orders', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id')->nullable();
			$table->integer('staff_id')->nullable();
			$table->integer('guest_id')->nullable();
			$table->integer('transaction_id')->nullable();
			$table->integer('status_id')->default(1);
			$table->bigInteger('affiliate_id')->nullable();
			$table->bigInteger('coupon_id')->nullable();
			$table->string('coupon_name')->nullable();
			$table->string('coupon_type')->default('customer')->comment('customer , affilate');
			$table->bigInteger('address_id')->nullable();
			$table->string('code', 191)->nullable();
            $table->string('barcode', 191)->nullable();
            $table->string('payment_status', 20)->nullable()->default('unpaid');
			$table->string('pmethod', 20)->default('Cash');
			$table->text('payment_details')->nullable();
			$table->text('shipping_address')->nullable();
			$table->text('shipment_details')->nullable();
			$table->float('sub_total')->default(0.00);
			$table->float('grand_total')->default(0.00);
			$table->float('shipping')->default(0.00);
			$table->float('discount')->default(0.00);
			$table->float('tax')->default(0.00);
			$table->integer('items')->default(0);
			$table->string('note')->nullable();
			$table->float('extra_discount')->default(0.00);
			$table->string('discount_format')->nullable();
			$table->string('currency')->nullable();
			$table->float('coupon_discount')->default(0.00);
			$table->integer('viewed')->default(0);
			$table->string('device')->default('web');
			$table->string('type')->nullable()->comment('pos, online');
			$table->date('invoicedate')->nullable();
			$table->date('invoiceduedate')->nullable();
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
		Schema::drop('orders');
	}

}
