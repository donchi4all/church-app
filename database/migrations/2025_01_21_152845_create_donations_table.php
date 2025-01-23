<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->string('donor_name')->nullable();
            $table->string('email')->nullable();
            $table->decimal('amount', 15, 2); // Amount in your desired currency
            $table->string('currency', 10)->default('NGN'); // Currency (e.g., NGN, USD)
            $table->string('payment_method')->comment('paypal, paystack, bank');
            $table->string('transaction_reference')->nullable(); // Transaction reference
            $table->enum('status', ['pending', 'processing', 'success', 'failed'])->default('pending'); // Status

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
