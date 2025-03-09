<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class ClientController extends Controller
{
    /**
     * Display the client dashboard.
     */
    public function dashboard(): View
    {
        $user = auth()->user();
        
        // Récupération des statistiques
        $totalSinistres = $user->sinistres()->count();
        $sinistresEnAttente = $user->sinistres()->where('status', 'en_attente')->count();
        $sinistresValides = $user->sinistres()->where('status', 'validé')->count();
        $sinistresExpertise = $user->sinistres()->where('status', 'expertise')->count();
        
        // Récupération des 5 derniers sinistres
        $derniersSinistres = $user->sinistres()
            ->latest()
            ->take(5)
            ->get();

        return view('client.dashboard', compact(
            'totalSinistres',
            'sinistresEnAttente',
            'sinistresValides',
            'sinistresExpertise',
            'derniersSinistres'
        ));
    }
}
