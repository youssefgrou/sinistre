<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_method',
        'payment_id',
        'amount',
        'name',
        'address',
        'phone',
        'cheque_number',
        'bank_name',
        'transaction_id',
        'bank_name_virement',
        'receipt_number',
        'status',
        'user_id',
        'sinistre_id'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
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
