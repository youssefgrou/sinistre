<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'sinistre_id',
        'nom',
        'type_document',
        'chemin_fichier',
        'taille_fichier',
        'type_mime'
    ];

    public function sinistre(): BelongsTo
    {
        return $this->belongsTo(Sinistre::class);
    }
}
