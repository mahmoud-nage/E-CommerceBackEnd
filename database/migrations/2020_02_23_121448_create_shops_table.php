<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateShopsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('shops', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id');
			$table->string('name_ar', 200)->nullable();
			$table->string('name_en', 200);
			$table->string('logo')->nullable();
			$table->text('sliders')->nullable();
			$table->string('address', 500)->nullable();
			$table->string('facebook')->nullable();
			$table->string('google')->nullable();
			$table->string('twitter')->nullable();
			$table->string('youtube')->nullable();
			$table->string('slug')->nullable();
			$table->string('meta_title')->nullable();
			$table->text('meta_description')->nullable();
			$table->string('type')->nullable();
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
		Schema::drop('shops');
	}

}
