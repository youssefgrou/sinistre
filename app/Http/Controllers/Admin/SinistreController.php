<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sinistre;
use Illuminate\Http\Request;
use Illuminate\View\View;
use PDF;
use League\Csv\Writer;
use SplTempFileObject;

class SinistreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Sinistre::with('user')->latest();

        if ($request->filled('search')) {
            $search = '%' . $request->search . '%';
            $query->where(function($q) use ($search) {
                $q->where('numero_sinistre', 'like', $search)
                  ->orWhere('immatriculation', 'like', $search)
                  ->orWhere('marque', 'like', $search)
                  ->orWhere('modele', 'like', $search)
                  ->orWhereHas('user', function($q) use ($search) {
                      $q->where('name', 'like', $search)
                        ->orWhere('email', 'like', $search);
                  });
            });
        }

        $sinistres = $query->paginate(10)->withQueryString();
        return view('admin.sinistres.index', compact('sinistres'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Sinistre $sinistre): View
    {
        $sinistre->load(['user', 'documents', 'payments.user']);
        
        return view('admin.sinistres.show', compact('sinistre'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sinistre $sinistre)
    {
        $validated = $request->validate([
            'status' => 'required|in:en_attente,en_cours,expertise,validé,refusé',
            'commentaire_admin' => 'nullable|string'
        ]);

        $sinistre->update($validated);

        return redirect()->route('admin.sinistres.show', $sinistre)
            ->with('success', 'Le statut du sinistre a été mis à jour avec succès.');
    }

    /**
     * Export sinistres to PDF
     */
    public function exportPDF(Request $request)
    {
        $query = Sinistre::with('user')->latest();
        
        if ($request->filled('search')) {
            $search = '%' . $request->search . '%';
            $query->where(function($q) use ($search) {
                $q->where('numero_sinistre', 'like', $search)
                  ->orWhere('immatriculation', 'like', $search)
                  ->orWhere('marque', 'like', $search)
                  ->orWhere('modele', 'like', $search)
                  ->orWhereHas('user', function($q) use ($search) {
                      $q->where('name', 'like', $search)
                        ->orWhere('email', 'like', $search);
                  });
            });
        }

        $sinistres = $query->get();
        
        $pdf = PDF::loadView('admin.sinistres.exports.pdf', compact('sinistres'));
        
        return $pdf->download('sinistres-' . now()->format('Y-m-d') . '.pdf');
    }

    /**
     * Export sinistres to CSV
     */
    public function exportCSV(Request $request)
    {
        $query = Sinistre::with(['user', 'payments'])->latest();
        
        if ($request->filled('search')) {
            $search = '%' . $request->search . '%';
            $query->where(function($q) use ($search) {
                $q->where('numero_sinistre', 'like', $search)
                  ->orWhere('immatriculation', 'like', $search)
                  ->orWhere('marque', 'like', $search)
                  ->orWhere('modele', 'like', $search)
                  ->orWhereHas('user', function($q) use ($search) {
                      $q->where('name', 'like', $search)
                        ->orWhere('email', 'like', $search);
                  });
            });
        }

        $sinistres = $query->get();
        
        $csv = Writer::createFromFileObject(new SplTempFileObject());
        
        // Add headers
        $csv->insertOne([
            'N° Sinistre',
            'Client',
            'Email',
            'Véhicule',
            'Immatriculation',
            'Date',
            'Heure',
            'Type',
            'Statut',
            'Montant Payé',
            'Date Dernier Paiement'
        ]);
        
        // Add data
        foreach ($sinistres as $sinistre) {
            $typesSinistres = [
                'vol_tentative_vol' => 'Vol et tentative de vol',
                'vandalisme_degradations' => 'Vandalisme et dégradations volontaires',
                'incendie_explosion' => 'Incendie et explosion',
                'bris_glaces' => 'Bris de glaces',
                'collision_route' => 'Collission de la Route'
            ];
            
            $totalPayments = $sinistre->payments->sum('amount');
            $lastPayment = $sinistre->payments->sortByDesc('created_at')->first();
            
            $csv->insertOne([
                $sinistre->numero_sinistre,
                $sinistre->user->name,
                $sinistre->user->email,
                $sinistre->marque . ' ' . $sinistre->modele,
                $sinistre->immatriculation,
                $sinistre->date_sinistre->format('d/m/Y'),
                $sinistre->heure_sinistre,
                $typesSinistres[$sinistre->type_sinistre] ?? ucfirst(str_replace('_', ' ', $sinistre->type_sinistre)),
                ucfirst(str_replace('_', ' ', $sinistre->status)),
                $totalPayments > 0 ? number_format($totalPayments, 2) . ' MAD' : 'Non payé',
                $lastPayment ? $lastPayment->created_at->format('d/m/Y') : '-'
            ]);
        }
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="sinistres-' . now()->format('Y-m-d') . '.csv"',
            'Content-Encoding' => 'UTF-8',
            'Content-Transfer-Encoding' => 'binary'
        ];
        
        return response($csv->getContent(), 200, $headers);
    }

    /**
     * Generate a PDF document for a single sinistre.
     */
    public function print(Sinistre $sinistre)
    {
        $sinistre->load(['user', 'payments']);
        
        $pdf = PDF::loadView('admin.sinistres.print', compact('sinistre'));
        
        return $pdf->download('sinistre-' . $sinistre->numero_sinistre . '.pdf');
    }
} 