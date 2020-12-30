<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name_ar', 191)->nullable();
            $table->string('name_en', 191);
            $table->longText('desc_ar')->nullable();
            $table->longText('desc_en');
            $table->string('label_ar')->nullable();
            $table->string('label_en')->nullable();
            $table->text('slug');
            $table->integer('user_id');
            $table->string('added_by', 191)->default('admin');
            $table->integer('category_id')->nullable();
            $table->integer('subCategory_id')->nullable();
            $table->integer('subSubCategory_id')->nullable();
            $table->integer('brand_id')->nullable();
            $table->text('photos')->nullable();
            $table->string('thumbnail_img', 191)->nullable();
            $table->string('featured_img', 191)->nullable();
            $table->string('flash_deal_img', 191)->nullable();
            $table->longText('tags')->nullable();
            $table->integer('active')->default(1);
            $table->integer('in_home')->default(0);
            $table->integer('is_affiliate')->default(0);
            $table->integer('is_package')->default(0);
            $table->integer('code')->nullable();
            $table->integer('code_type')->nullable();
            $table->integer('barcode')->nullable();
            $table->string('unit', 20)->nullable();
            $table->integer('num_of_sale')->default(0);
            $table->double('rating', 8, 2)->default(0.00);
            $table->text('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_img')->nullable();
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
        Schema::dropIfExists('products');
    }
}
