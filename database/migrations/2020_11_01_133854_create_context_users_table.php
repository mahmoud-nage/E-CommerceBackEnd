<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContextUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('context_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code');
			$table->integer('user_id');
			$table->integer('contest_id');
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
        Schema::dropIfExists('context_users');
    }
}
