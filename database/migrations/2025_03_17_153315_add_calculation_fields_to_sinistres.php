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
        Schema::table('sinistres', function (Blueprint $table) {
            $table->decimal('montant_sinistre', 10, 2)->nullable();
            $table->decimal('franchise', 10, 2)->nullable();
            $table->decimal('taux_couverture', 5, 2)->default(80.00); // Default 80%
            $table->decimal('indemnisation', 10, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sinistres', function (Blueprint $table) {
            $table->dropColumn(['montant_sinistre', 'franchise', 'taux_couverture', 'indemnisation']);
        });
    }
};
