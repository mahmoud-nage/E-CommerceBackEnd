<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name_ar', 191)->nullable()->unique();
            $table->string('name_en', 191)->unique();
            $table->unsignedBigInteger('currency_id')->nullable();
            $table->string('icon', 191);
            $table->string('lat', 191)->nullable();
            $table->string('lon', 191)->nullable();
            $table->string('locales', 191)->nullable();
            $table->tinyInteger('active')->default(1);
            $table->tinyInteger('default')->default(0);
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
        Schema::dropIfExists('countries');
    }
}
