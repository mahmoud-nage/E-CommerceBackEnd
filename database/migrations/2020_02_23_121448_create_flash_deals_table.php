<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFlashDealsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('flash_deals', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name_ar', 191)->nullable();
			$table->string('name_en', 191);
			$table->string('label_ar', 191)->nullable();
			$table->string('label_en', 191)->nullable();
			$table->string('stockMsg_ar', 191)->nullable();
			$table->string('stockMsg_en', 191)->nullable();
			$table->dateTime('start_date')->nullable();
			$table->dateTime('end_date')->nullable();
			$table->integer('country_id')->nullable();
            $table->string('show_type', 10)->default('general')->comment('general, app ,website');
            $table->integer('visit_count')->default(0);
			$table->integer('active')->default(0);
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
		Schema::drop('flash_deals');
	}

}
