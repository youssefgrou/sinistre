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
            $table->id();
            $table->foreignId('sinistre_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('payment_id')->unique();
            $table->decimal('amount', 10, 2);
            $table->enum('payment_method', ['cheque', 'virement', 'especes']);
            $table->string('name');
            $table->string('address');
            $table->string('phone');
            $table->string('status')->default('pending');
            // Cheque specific fields
            $table->string('cheque_number')->nullable();
            $table->string('bank_name')->nullable();
            // Virement specific fields
            $table->string('transaction_id')->nullable();
            $table->string('bank_name_virement')->nullable();
            // Especes specific field
            $table->string('receipt_number')->nullable();
            $table->timestamps();
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
