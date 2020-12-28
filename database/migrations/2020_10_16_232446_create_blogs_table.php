<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration {

	public function up()
	{
		Schema::create('blogs', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name_ar', 191)->nullable();
			$table->string('name_en', 191);
			$table->longText('desc_ar')->nullable();
			$table->longText('desc_en');
			$table->string('image', 191)->nullable();
			$table->boolean('active')->default(1);
			$table->boolean('in_home')->default(0);
			$table->bigInteger('read_num')->default(0);
            $table->string('meta_title',191)->nullable();
            $table->text('meta_description')->nullable();
            $table->bigInteger('country_id')->unsigned()->nullable();
            $table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('blogs');
	}
}
