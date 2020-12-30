<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('docid')->nullable();
            $table->string('SSN')->nullable();
            $table->double('debit')->default(0);
            $table->double('credit')->default(0);
            $table->integer('countProducts')->default(0);
            $table->integer('countOrders')->default(0);
            $table->integer('countTransaction')->default(0);
            $table->string('name_ar', 191)->nullable();
            $table->string('name_en', 191);
            $table->string('logo', 191)->nullable();
            $table->string('desc_ar', 191)->nullable();
            $table->string('desc_en', 191)->nullable();
            $table->tinyInteger('is_blocked')->default(0);
            $table->tinyInteger('active')->default(0);
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
        Schema::dropIfExists('suppliers');
    }
}
