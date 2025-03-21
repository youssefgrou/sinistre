<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function update(Payment $payment)
    {
        $payment->update([
            'status' => 'completed'
        ]);

        // Update the sinistre's montant_sinistre with only completed payments
        $sinistre = $payment->sinistre;
        $totalCompletedPayments = $sinistre->payments()
            ->where('status', 'completed')
            ->sum('amount');

        $sinistre->update([
            'montant_sinistre' => $totalCompletedPayments
        ]);

        return redirect()->back()->with('success', 'Paiement validé avec succès.');
    }
} 