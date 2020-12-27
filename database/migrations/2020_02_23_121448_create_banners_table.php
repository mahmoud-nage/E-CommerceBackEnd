<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBannersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('banners', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('image')->nullable();
			$table->string('url', 1000)->nullable();
			$table->integer('position')->default(0)->comment('sizing');
			$table->integer('page_type')->default(0)->comment('home, flashDeal, offer, ...');
            $table->integer('visit_count')->default(0);
            $table->dateTime('from')->nullable();
            $table->dateTime('to')->nullable();
			$table->integer('active')->default(0);
			$table->string('show_type', 10)->default('general')->comment('general, app ,website');
			$table->tinyInteger('type')->default(0)->comment('1 => banners, 2 => sliders');
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
		Schema::drop('banners');
	}

}
