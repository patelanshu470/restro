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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('special_id')->nullable();
            $table->string('restaurent_id')->nullable();
            $table->string('name')->nullable();
            $table->longText('desc')->nullable();
            $table->string('cost_price')->nullable();
            $table->string('sell_price')->nullable();
            $table->string('product_category')->nullable();
            $table->string('subcategory_id')->nullable();
            $table->string('discount')->nullable()->comment("%");
            $table->string('quantity')->nullable();
            $table->string('weight_per_piece')->nullable();
            $table->string('type')->comment("veg/non-veg")->nullable();
            $table->string('cooking_time')->nullable();
            $table->string('size')->nullable();
            $table->string('addon_id')->nullable();
            $table->string('discount_type')->nullable();
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('products');
    }
};
