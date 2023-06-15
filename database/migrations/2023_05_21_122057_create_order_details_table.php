<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('orderID');
            $table->unsignedBigInteger('productID');
            $table->integer('quantity');
            $table->float('price');
            // add any other columns as needed
            $table->timestamps();
            $table->foreign('orderID')
                ->references('orderID')
                ->on('orders')
                ->onDelete('cascade');
            $table->foreign('productID')
                ->references('id')
                ->on('product')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
