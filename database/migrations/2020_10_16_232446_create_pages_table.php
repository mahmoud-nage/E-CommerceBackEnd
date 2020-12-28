<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration {

	public function up()
	{
		Schema::create('pages', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name_ar', 191)->nullable();
			$table->string('name_en', 191);
			$table->longText('desc_ar')->nullable();
			$table->longText('desc_en');
			$table->string('image', 191);
			$table->string('link', 191);
			$table->string('type', 191)->default('page')->comment('policy, page');
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
