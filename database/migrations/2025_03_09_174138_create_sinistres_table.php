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
        Schema::create('sinistres', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('numero_sinistre')->unique();
            $table->string('immatriculation');
            $table->string('marque');
            $table->string('modele');
            $table->date('date_sinistre');
            $table->time('heure_sinistre');
            $table->text('lieu_sinistre');
            $table->text('description');
            $table->text('circonstances');
            $table->enum('type_sinistre', [
                'vol_tentative_vol',
                'vandalisme_degradations',
                'incendie_explosion',
                'bris_glaces',
                'collision_route'
            ]);
            $table->enum('status', ['en_attente', 'en_cours', 'expertise', 'validé', 'refusé'])->default('en_attente');
            $table->text('commentaire_admin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sinistres');
    }
};
