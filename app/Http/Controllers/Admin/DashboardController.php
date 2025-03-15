<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sinistre;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            // Stats
            'totalClaims' => Sinistre::count(),
            'totalClients' => User::where('role', 'client')->count(),
            'activeClaims' => Sinistre::where('status', 'en_cours')->count(),

            // Recent claims
            'recentClaims' => Sinistre::with('user')
                ->latest()
                ->take(5)
                ->get(),

            // Recent clients
            'recentClients' => User::where('role', 'client')
                ->latest()
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