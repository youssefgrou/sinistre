<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $fillable = [
        'sinistre_id',
        'user_id',
        'amount',
        'currency',
        'payment_method',
        'payment_id',
        'status',
    ];

    public function sinistre(): BelongsTo
    {
        return $this->belongsTo(Sinistre::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
