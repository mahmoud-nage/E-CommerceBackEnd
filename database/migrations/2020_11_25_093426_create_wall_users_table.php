<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWallUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wall_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('promo_code');
            $table->string('gift_type');
            $table->integer('user_id');
            $table->integer('world_wall_id');
            $table->integer('status')->default(0);
            $table->integer('win')->default(0);
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
        Schema::dropIfExists('wall_users');
    }
}
