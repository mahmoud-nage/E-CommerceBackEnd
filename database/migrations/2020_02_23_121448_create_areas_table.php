<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAreasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('areas', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->string('name_ar', 191)->nullable();
			$table->string('name_en', 191);
			$table->integer('city_id')->nullable();
            $table->string('lat', 191)->nullable();
            $table->string('lon', 191)->nullable();
            $table->boolean('active')->default(1);
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
		Schema::drop('areas');
	}

}
