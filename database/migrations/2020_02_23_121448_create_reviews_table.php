<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReviewsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reviews', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('product_id');
			$table->integer('user_id');
			$table->integer('rate')->default(0);
			$table->text('comment');

            $table->boolean('active')->default(0);
            $table->boolean('in_home')->default(0);
            $table->bigInteger('likes_count')->default(0);
            $table->bigInteger('dislikens_count')->default(0);
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
		Schema::drop('reviews');
	}

}
