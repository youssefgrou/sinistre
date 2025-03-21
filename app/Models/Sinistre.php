<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sinistre extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'numero_sinistre',
        'immatriculation',
        'marque',
        'modele',
        'date_sinistre',
        'heure_sinistre',
        'lieu_sinistre',
        'description',
        'circonstances',
        'type_sinistre',
        'status',
        'commentaire_admin',
        'montant_sinistre',
        'franchise',
        'taux_couverture',
        'indemnisation'
    ];

    protected $casts = [
        'date_sinistre' => 'date',
        'montant_sinistre' => 'decimal:2',
        'franchise' => 'decimal:2',
        'taux_couverture' => 'decimal:2',
        'indemnisation' => 'decimal:2'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Calculate and set the indemnisation amount
     */
    public function calculateIndemnisation()
    {
        if ($this->montant_sinistre && $this->franchise && $this->taux_couverture) {
            $this->indemnisation = ($this->montant_sinistre - $this->franchise) * ($this->taux_couverture / 100);
            $this->save();
        }
        return $this->indemnisation;
    }

    /**
     * Get the formatted montant_sinistre
     */
    public function getFormattedMontantSinistreAttribute()
    {
        return number_format($this->montant_sinistre, 2) . ' MAD';
    }

    /**
     * Get the formatted franchise
     */
    public function getFormattedFranchiseAttribute()
    {
        return number_format($this->franchise, 2) . ' MAD';
    }

    /**
     * Get the formatted indemnisation
     */
    public function getFormattedIndemnisationAttribute()
    {
        return number_format($this->indemnisation, 2) . ' MAD';
    }
}
