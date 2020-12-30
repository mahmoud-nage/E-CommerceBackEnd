<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries_products', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->integer('country_id');

            $table->float('unit_price');
            $table->float('purchase_price', 10, 0)->nullable();
            $table->integer('alert')->default(0);
            $table->integer('current_stock')->default(0);

            $table->longText('choice_options')->nullable();
            $table->longText('colors')->nullable();
            $table->longText('variations')->nullable();

            $table->integer('warehouse_id')->nullable();

            $table->string('shipping_type', 20)->nullable()->default('flat_rate');
            $table->float('shipping_cost')->nullable()->default(0.00);

            $table->integer('num_of_sale')->default(0);

            $table->float('discount')->default(0);
            $table->string('discount_type', 10)->default('amount')->comment('amount, percentage');

            $table->float('tax')->default(0);
            $table->string('tax_type', 10)->default('amount')->comment('amount, percentage');


            $table->integer('contest')->default(0);
            $table->integer('location')->default(0);
            $table->integer('page')->default(0);

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
        Schema::dropIfExists('countries_products');
    }
}
