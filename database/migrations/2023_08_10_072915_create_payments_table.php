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
        Schema::create('payments', function (Blueprint $table) {
            $table->id('payment_id');
            $table->string('transaction_id');
            $table->unsignedBigInteger('user_id');
            $table->string('payment_method')->default('paypal');
            $table->decimal('total_amount', 10, 2);
            $table->string('payer_id');
            $table->string('payer_name');
            $table->string('payer_email');
            $table->string('payment_status');
            $table->timestamp('transaction_date');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
