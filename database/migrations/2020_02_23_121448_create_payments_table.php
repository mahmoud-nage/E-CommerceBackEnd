<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaymentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('payments', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('paymentable_id');
			$table->string('paymentable_type', 191);
			$table->integer('payment_method_id')->nullable();
			$table->longText('order_ids')->nullable();
			$table->float('amount')->default(0.00);
			$table->text('payment_details')->nullable();
			$table->string('image', 191)->nullable();
			$table->integer('status')->default(0);
			$table->string('provider')->default('web');
            $table->string('type')->default('seller')->comment('seller, affilate');
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
		Schema::drop('payments');
	}

}
