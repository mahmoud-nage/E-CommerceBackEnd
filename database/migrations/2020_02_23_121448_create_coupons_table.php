<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCouponsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('coupons', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('type');
			$table->string('code');
			$table->text('details');
			$table->float('discount');
			$table->string('discount_type', 100);
			$table->integer('start_date');
			$table->integer('end_date');
            $table->integer('visit_count')->default(0);
            $table->boolean('active')->default(1);
            $table->boolean('in_cart')->default(0);
            $table->string('show_type', 10)->default('general')->comment('general, app ,website');
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
		Schema::drop('coupons');
	}

}
