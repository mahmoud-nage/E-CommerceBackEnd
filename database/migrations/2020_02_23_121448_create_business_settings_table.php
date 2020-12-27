<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBusinessSettingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('business_settings', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('type', 191);
			$table->text('value')->nullable();
            $table->bigInteger('country_id')->unsigned()->nullable();
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
		Schema::drop('business_settings');
	}

}
