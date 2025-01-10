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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders');

            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products');

            //product size
            $table->unsignedBigInteger('size_id');
            $table->foreign('size_id')->references('id')->on('product_sizes')->onDelete('cascade');
            //color
            $table->unsignedBigInteger('color_id');
            $table->foreign('color_id')->references('id')->on('product_colors')->onDelete('cascade');

            // orderd quantity
            $table->string('qty');
            

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
        Schema::dropIfExists('order_items');
    }
};
