<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');


            $table->string('provider', 10)->nullable();
            $table->string('provider_id', 191)->nullable();
            $table->string('remember_token', 191)->nullable();
            $table->string('api_token', 60)->nullable();
            $table->text('fcm_token')->nullable();

            $table->string('avatar', 191)->nullable();
            $table->string('gender', 10)->nullable();
            $table->string('address', 191)->nullable();
            $table->date('dob')->nullable();


            $table->bigInteger('country_id', )->nullable();
            $table->bigInteger('city_id', )->nullable();
            $table->bigInteger('area_id')->nullable();
            $table->bigInteger('zone_id')->nullable();

            $table->string('postal_code', 20)->nullable();
            $table->string('reset_code', 10)->nullable();

            $table->string('phone', 20)->nullable();
            $table->float('balance')->default(0.00);
            $table->string('device')->default('web');
            $table->string('code')->nullable();
            $table->string('default_lang')->nullable();
            $table->string('signature')->nullable();

            $table->boolean('active')->default(1);

            $table->boolean('blocked')->default(0);
            $table->text('blocked_reason')->nullable();

            $table->string('lat', 191)->nullable();
            $table->string('lon', 191)->nullable();

            $table->bigInteger('userable_id')->unsigned()->nullable();
            $table->string('userable_type', 191)->nullable();

            $table->string('user_type', 10)->default('customer');

            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
