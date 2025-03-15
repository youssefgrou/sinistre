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
        'commentaire_admin'
    ];

    protected $casts = [
        'date_sinistre' => 'date',
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
}
