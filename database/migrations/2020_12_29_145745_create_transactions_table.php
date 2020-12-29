<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('account_id')->nullable();
            $table->integer('bill_id')->nullable();
            $table->integer('staff_id')->nullable();
            $table->integer('trans_category_id')->nullable();
            $table->string('customer_id', 191)->nullable();
            $table->string('customer_name', 191)->nullable();
            $table->integer('debit')->nullable();
            $table->string('credit', 191)->nullable();
            $table->string('pmethod', 191)->nullable();
            $table->string('note', 191)->nullable();
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('transactions');
    }
}
