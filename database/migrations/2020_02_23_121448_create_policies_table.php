<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePoliciesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('policies', function(Blueprint $table)
		{
            $table->string('name_ar', 191)->nullable();
            $table->string('name_en', 191);
            $table->longText('desc_ar')->nullable();
            $table->longText('desc_en');
            $table->string('show_type', 10)->default('general')->comment('general, app ,website');
            $table->string('image', 191)->nullable();
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
		Schema::drop('policies');
	}

}
