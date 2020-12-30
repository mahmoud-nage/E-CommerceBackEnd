<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('staff_id')->nullable();
            $table->integer('supplier_id')->nullable();
            $table->integer('transaction_id')->nullable();
            $table->integer('status')->nullable();
            $table->string('code', 191)->nullable();
            $table->string('barcode', 191)->nullable();
            $table->string('pmethod', 20)->default('Cash');
            $table->text('payment_details')->nullable();
            $table->text('shipping_address')->nullable();
            $table->text('shipment_details')->nullable();
            $table->double('sub_total', 8, 2)->default(0.00);
            $table->double('grand_total', 8, 2)->default(0.00);
            $table->double('shipping', 8, 2)->default(0.00);
            $table->double('discount', 8, 2)->default(0.00);
            $table->double('tax', 8, 2)->default(0.00);
            $table->integer('items')->default(0);
            $table->string('note', 191)->nullable();
            $table->double('extra_discount', 8, 2)->default(0.00);
            $table->string('discount_format', 191)->nullable();
            $table->string('currency', 191)->nullable();
            $table->double('coupon_discount', 8, 2)->default(0.00);
            $table->date('invoicedate')->nullable();
            $table->date('invoiceduedate')->nullable();
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
        Schema::dropIfExists('purchase_orders');
    }
}
