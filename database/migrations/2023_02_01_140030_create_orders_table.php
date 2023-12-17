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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->decimal('subtotal',8,2)->nullable();
            $table->decimal('total_discount',8,2)->nullable();
            $table->decimal('grand_total',8,2)->nullable();
            $table->string('payment_method')->nullable();
            $table->string('billing_contact_name')->nullable();
            $table->string('billing_contact_email')->nullable();
            $table->string('billing_contact_number',20)->nullable();
            $table->string('shipping_contact_name')->nullable();
            $table->string('shipping_contact_email')->nullable();
            $table->string('shipping_contact_number',20)->nullable();
            $table->text('order_note')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('orders');
    }
};
