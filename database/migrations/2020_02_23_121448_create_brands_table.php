<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBrandsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('brands', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name_ar', 191)->nullable();
			$table->string('name_en', 191);
			$table->string('logo', 100)->nullable();
			$table->boolean('in_home')->default(0);
			$table->boolean('active')->default(1);
			$table->string('slug', 191)->nullable();
			$table->string('meta_title',191)->nullable();
			$table->text('meta_description')->nullable();
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
		Schema::drop('brands');
	}

}
