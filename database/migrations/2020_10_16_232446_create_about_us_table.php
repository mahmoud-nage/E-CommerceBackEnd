<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutUsTable extends Migration {

	public function up()
	{
		Schema::create('about_us', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name_ar', 191)->nullable();
			$table->string('name_en', 191);
			$table->longText('desc_ar')->nullable();
			$table->longText('desc_en');
			$table->boolean('active')->default(1);
			$table->boolean('in_home')->default(0);
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('about_us');
	}
}
