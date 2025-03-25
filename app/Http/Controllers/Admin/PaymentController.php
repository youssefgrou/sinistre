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

        return redirect()->back()->with('success', 'Paiement validé avec succès.');
    }
} 