<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('type');
            $table->string('code');
            $table->text('details');
            $table->double('discount', 8, 2);
            $table->string('discount_type', 100);
            $table->integer('start_date');
            $table->integer('end_date');
            $table->integer('visit_count')->default(0);
            $table->tinyInteger('active')->default(1);
            $table->tinyInteger('in_cart')->default(0);
            $table->string('show_type', 10)->default('general')->comment('general, app ,website');
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
        Schema::dropIfExists('coupons');
    }
}
