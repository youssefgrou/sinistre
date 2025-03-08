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
        return view('client.dashboard');
    }
}
