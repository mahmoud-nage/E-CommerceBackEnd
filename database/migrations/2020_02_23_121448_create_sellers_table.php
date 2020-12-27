<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSellersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sellers', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id');
			$table->integer('verification_status')->default(0);
			$table->text('verification_info')->nullable();
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
			$table->integer('egyptian_mail_status')->default(0);
			$table->string('full_name')->nullable();
			$table->string('SSN')->nullable();
			$table->float('admin_to_pay')->default(0.00);
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
		Schema::drop('sellers');
	}

}
