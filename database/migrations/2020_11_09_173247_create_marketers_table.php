<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarketersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marketers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('visits')->default(0);
            $table->bigInteger('android')->default(0);;
            $table->bigInteger('ios')->default(0);;
            $table->bigInteger('app_gallary')->default(0);;
            $table->string('url')->default('https://newfaceeg.com/app/');
            $table->text('code');
            $table->longText('tags')->nullable();
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
        Schema::dropIfExists('marketers');
    }
}
