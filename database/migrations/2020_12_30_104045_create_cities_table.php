<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_ar', 191)->nullable();
            $table->string('name_en', 191);
            $table->integer('country_id')->nullable();
            $table->double('delivery_price')->default(0);
            $table->tinyInteger('delivery_free')->default(0);
            $table->string('lat', 191)->nullable();
            $table->string('lng', 191)->nullable();
            $table->tinyInteger('active')->default(1);
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
        Schema::dropIfExists('cities');
    }
}
