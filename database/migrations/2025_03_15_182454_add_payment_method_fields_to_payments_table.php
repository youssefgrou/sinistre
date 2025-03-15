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
        Schema::table('payments', function (Blueprint $table) {
            $table->string('cheque_number')->nullable()->after('status');
            $table->string('bank_name')->nullable()->after('cheque_number');
            $table->string('transaction_id')->nullable()->after('bank_name');
            $table->string('bank_name_virement')->nullable()->after('transaction_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn([
                'cheque_number',
                'bank_name',
                'transaction_id',
                'bank_name_virement'
            ]);
        });
    }
};
