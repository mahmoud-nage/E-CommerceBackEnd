<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVariationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('variations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('choices_values')->nullable();
            $table->string('sku', 191)->nullable();
            $table->string('qty', 191)->nullable();
            $table->double('price')->nullable();
            $table->bigInteger('product_id');
            $table->integer('country_product_id')->nullable();
            $table->string('image', 191)->nullable();
            $table->tinyInteger('active')->default(1);
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
        Schema::dropIfExists('variations');
    }
}
