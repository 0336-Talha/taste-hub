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
        //
        
        Schema::create('order_trackings', function (Blueprint $table) {
            $table->id();
    
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders');
    
            $table->unsignedBigInteger('owner_id');
            $table->foreign('owner_id')->references('id')->on('users');
    
            $table->string('tracking_number')->unique();
            $table->timestamps();
            //
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
