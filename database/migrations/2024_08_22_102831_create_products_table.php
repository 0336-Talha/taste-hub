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
            $table->string('title');
            $table->string('discription',1024);
            $table->integer('quantity');
            $table->integer('price');
            
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');

            $table->foreignId('sub_id')->constrained('sub_categories')->onDelete('cascade')->onUpdate('cascade');

            $table->foreignId('brand_id')->constrained('brands')->onDelete('cascade')->onUpdate('cascade');

            
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
