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
        Schema::create('slideshows', function (Blueprint $table) {
            $table->id('ssid');
            $table->string('title', 200);
            $table->string('subtitle', 200);
            $table->string('text', 250);
            $table->boolean('active');
            $table->string('img', 150);
            $table->string('link', 150);
            $table->integer('orderNum');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slideshows');
    }
};
