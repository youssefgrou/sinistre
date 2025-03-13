<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sinistre;
use App\Models\Client;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            // Stats
            'totalClaims' => Sinistre::count(),
            'newClients' => Client::where('created_at', '>=', now()->subDays(30))->count(),
            'activeClaims' => Sinistre::where('status', 'en_cours')->count(),
            'totalClients' => Client::count(),

            // Recent claims
            'recentClaims' => Sinistre::with('user')
                ->latest()
                ->take(5)
                ->get(),

            // Recent clients
            'recentClients' => Client::latest()
                ->take(5)
                ->get(),

            // Latest claim
            'latestClaim' => Sinistre::with('user')
                ->latest()
                ->first()
        ];

        return view('admin.dashboard', $data);
    }
} 