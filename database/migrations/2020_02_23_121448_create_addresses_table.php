<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAddressesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('addresses', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();

			$table->bigInteger('user_id');
            $table->bigInteger('country_id');
            $table->bigInteger('city_id' )->nullable();
            $table->bigInteger('area_id')->nullable();
            $table->bigInteger('zone_id')->nullable();

			$table->string('phone', 191);
			$table->string('phone1', 191)->nullable();
			$table->integer('building_no')->nullable();
			$table->integer('floor_no')->nullable();
			$table->integer('apartment_no')->nullable();
			$table->text('address_details')->nullable();

			$table->text('special_mark')->nullable();
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
		Schema::drop('addresses');
	}

}
