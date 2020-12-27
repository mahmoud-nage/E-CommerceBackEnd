<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotificationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('notifications', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->nullable();
            $table->string('title_ar', 191)->nullable();
            $table->string('title_en', 191);
            $table->text('body_ar')->nullable();
            $table->text('body_en');
			$table->boolean('seen')->default(0);
            $table->string('show_type', 10)->default('general')->comment('general, app ,website');
            $table->string('type', 191)->nullable('admin');
            $table->bigInteger('country_id')->unsigned()->nullable();
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
		Schema::drop('notifications');
	}

}
