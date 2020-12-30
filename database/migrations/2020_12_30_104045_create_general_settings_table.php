<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_settings', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('frontend_color')->default('default');
            $table->string('logo')->nullable();
            $table->string('admin_logo')->nullable();
            $table->string('admin_login_background')->nullable();
            $table->string('admin_login_sidebar')->nullable();
            $table->string('favicon', 191)->nullable();
            $table->string('site_ar', 191)->nullable();
            $table->string('site_en', 191);
            $table->string('address_ar')->nullable();
            $table->string('address_en')->nullable();
            $table->string('phone', 100)->nullable();
            $table->string('email')->nullable();
            $table->string('facebook', 1000)->nullable();
            $table->string('instagram', 1000)->nullable();
            $table->string('twitter', 1000)->nullable();
            $table->string('youtube', 1000)->nullable();
            $table->string('google_plus', 1000)->nullable();
            $table->string('google_play_store', 1000)->nullable();
            $table->string('apple_store', 1000)->nullable();
            $table->string('app_gallary_store', 1000)->nullable();
            $table->integer('withdrawal_duration')->default(0);
            $table->integer('cat_nav_count')->default(0);
            $table->string('lat', 191)->nullable();
            $table->string('lon', 191)->nullable();
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
        Schema::dropIfExists('general_settings');
    }
}
