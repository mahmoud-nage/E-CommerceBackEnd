<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_ar', 191)->nullable();
            $table->string('name_en', 191);
            $table->string('slug', 191)->nullable();
            $table->string('image', 191)->nullable();
            $table->tinyInteger('active')->default(1);
            $table->tinyInteger('in_home')->default(0);
            $table->integer('in_nav')->default(0)->comment('show in nav');
            $table->double('vendor_commission')->default(0);
            $table->string('meta_title', 191)->nullable();
            $table->text('meta_description')->nullable();
            $table->tinyInteger('type')->default(0)->comment('sub->1, subsub->2');
            $table->integer('parent_id')->default(0);
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
        Schema::dropIfExists('categories');
    }
}
