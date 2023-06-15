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
        Schema::create('products', function (Blueprint $table) {
            $table->id('productID');
            $table->string('pname');
            $table->double('price');
            $table->integer('quantity');
            $table->boolean('active');
            $table->string('img', 150);
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('category_id')->on('categories');
            $table->unsignedBigInteger('brand_id');
            $table->foreign('brand_id')->references('brand_id')->on('brands');
            $table->integer('orderNum');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
