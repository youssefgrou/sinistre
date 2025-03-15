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
        ]);

        $payment = Payment::create([
            'sinistre_id' => $sinistre->id,
            'user_id' => auth()->id(),
            'amount' => $validated['amount'],
            'currency' => 'MAD',
            'payment_method' => 'manual',
            'payment_id' => 'MAN-' . time(),
            'status' => 'pending',
        ]);

        return redirect()->route('client.sinistres.show', $sinistre)
            ->with('success', 'Payment information submitted successfully!');
    }
}
