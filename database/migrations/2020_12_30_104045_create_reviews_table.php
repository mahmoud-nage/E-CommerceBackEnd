<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('product_id');
            $table->integer('user_id');
            $table->integer('rate')->default(0);
            $table->text('comment');
            $table->tinyInteger('active')->default(0);
            $table->tinyInteger('in_home')->default(0);
            $table->bigInteger('likes_count')->default(0);
            $table->bigInteger('dislikens_count')->default(0);
            $table->unsignedBigInteger('country_id')->nullable();
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
        Schema::dropIfExists('reviews');
    }
}
