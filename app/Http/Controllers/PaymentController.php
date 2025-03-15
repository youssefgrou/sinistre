<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Sinistre;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function create(Sinistre $sinistre)
    {
        return view('payments.create', compact('sinistre'));
    }

    public function store(Request $request, Sinistre $sinistre)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string|in:cheque,virement',
            'cheque_number' => 'required_if:payment_method,cheque|string|max:50|nullable',
            'bank_name' => 'required_if:payment_method,cheque|string|max:100|nullable',
            'transaction_id' => 'required_if:payment_method,virement|string|max:50|nullable',
            'bank_name_virement' => 'required_if:payment_method,virement|string|max:100|nullable',
        ]);

        $payment = Payment::create([
            'sinistre_id' => $sinistre->id,
            'user_id' => auth()->id(),
            'amount' => $validated['amount'],
            'currency' => 'MAD',
            'payment_method' => $validated['payment_method'],
            'payment_id' => $validated['payment_method'] === 'cheque' 
                ? 'CHQ-' . $validated['cheque_number']
                : 'VIR-' . $validated['transaction_id'],
            'status' => 'pending',
            'cheque_number' => $validated['cheque_number'] ?? null,
            'bank_name' => $validated['bank_name'] ?? null,
            'transaction_id' => $validated['transaction_id'] ?? null,
            'bank_name_virement' => $validated['bank_name_virement'] ?? null,
        ]);

        return redirect()->route('client.sinistres.show', $sinistre)
            ->with('success', 'Informations de paiement soumises avec succès !');
    }
}
