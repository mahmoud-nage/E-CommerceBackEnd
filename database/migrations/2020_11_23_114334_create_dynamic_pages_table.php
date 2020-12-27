<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDynamicPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dynamic_pages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('image');
            $table->text('url')->nullable();
            $table->boolean('registered')->default(0)->comment('choice if this page need auth or not');
            $table->boolean('webView')->default(0)->comment('choice if this page is webview or app page');
            $table->string('type')->default('general')->comment('general, app, web');
            $table->bigInteger('views')->default(0);
            $table->bigInteger('android')->default(0);
            $table->bigInteger('app_gallery')->default(0);
            $table->bigInteger('apple')->default(0);
            $table->boolean('active')->default(0);
            $table->dateTime('from')->default(0);
            $table->dateTime('to')->default(0);
            $table->boolean('date_active')->default(0)->comment('choice active date or not');
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
        Schema::dropIfExists('dynamic_pages');
    }
}
