<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Sinistre;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function create(Sinistre $sinistre)
    {
        // Check if indemnisation has been calculated
        if ($sinistre->indemnisation === null) {
            return redirect()->route('client.sinistres.show', $sinistre)
                ->with('error', 'Le paiement ne peut être effectué qu\'après le calcul de l\'indemnisation par l\'administrateur.');
        }

        // Calculate remaining franchise to be paid
        $totalPaidAmount = $sinistre->payments()->where('status', 'completed')->sum('amount');
        $remainingAmount = $sinistre->franchise - $totalPaidAmount;

        return view('payments.create', compact('sinistre', 'remainingAmount'));
    }

    public function store(Request $request, Sinistre $sinistre)
    {
        // Check if indemnisation has been calculated
        if ($sinistre->indemnisation === null) {
            return redirect()->route('client.sinistres.show', $sinistre)
                ->with('error', 'Le paiement ne peut être effectué qu\'après le calcul de l\'indemnisation par l\'administrateur.');
        }

        // Check if franchise has already been paid
        $totalPaidAmount = $sinistre->payments()->where('status', 'completed')->sum('amount');
        if ($totalPaidAmount >= $sinistre->franchise) {
            return redirect()->route('client.sinistres.show', $sinistre)
                ->with('error', 'La franchise a déjà été entièrement payée.');
        }

        $validated = $request->validate([
            'payment_method' => 'required|in:cheque,virement,especes',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'amount' => 'required|numeric|in:' . $sinistre->franchise, // Force amount to match franchise
            // Conditional validation based on payment method
            'cheque_number' => 'required_if:payment_method,cheque|nullable|string|max:50',
            'bank_name' => 'required_if:payment_method,cheque|nullable|string|max:100',
            'transaction_id' => 'required_if:payment_method,virement|nullable|string|max:100',
            'bank_name_virement' => 'required_if:payment_method,virement|nullable|string|max:100',
            'receipt_number' => 'required_if:payment_method,especes|nullable|string|max:50',
        ]);

        // Override the amount to ensure it's exactly the franchise amount
        $validated['amount'] = $sinistre->franchise;

        // Generate a unique payment ID based on the method
        $prefix = match($validated['payment_method']) {
            'cheque' => 'CHQ',
            'virement' => 'VIR',
            'especes' => 'ESP',
        };
        
        $paymentCount = Payment::count() + 1;
        $paymentId = $prefix . '-' . str_pad($paymentCount, 4, '0', STR_PAD_LEFT);

        // Create the payment record
        $payment = new Payment([
            ...$validated,
            'status' => 'pending',
            'user_id' => auth()->id(),
            'payment_id' => $paymentId
        ]);

        $sinistre->payments()->save($payment);

        return redirect()->route('client.sinistres.show', $sinistre)
            ->with('success', 'Votre paiement a été enregistré avec succès.');
    }
}
