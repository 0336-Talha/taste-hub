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
            $table->string('name');
            $table->string('address');
            $table->string('zip');
            $table->string('city');
            
            // Adding foreign key constraints for countries and states
            $table->foreignId('country_id')->constrained('countries')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('state_id')->constrained('states')->onDelete('cascade')->onUpdate('cascade');
            
            // Linking with users table
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            
            // Linking with orders table (nullable in case an order might not be created initially)
            $table->foreignId('order_id')->nullable()->constrained('orders')->onDelete('cascade')->onUpdate('cascade');
            
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
