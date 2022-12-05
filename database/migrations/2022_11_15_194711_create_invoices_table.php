<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('vendor_id');
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone');
            $table->string('customer_country');
            $table->string('customer_city');
            $table->text('customer_address');
            $table->longText('order_comments');
            $table->string('payment_method');
            $table->string('payment_status')->default('unpaid');
            $table->string('order_status')->default('processing');
            $table->string('coupon')->nullable();
            $table->float('subtotal');
            $table->float('delivery_charge');
            $table->float('total_price');
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
        Schema::dropIfExists('invoices');
    }
};
