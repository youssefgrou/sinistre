<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sinistre;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SinistreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $sinistres = Sinistre::with('user')->latest()->paginate(10);
        return view('admin.sinistres.index', compact('sinistres'))
            ->with('layout', 'layouts.admin');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sinistre $sinistre): View
    {
        return view('admin.sinistres.show', compact('sinistre'))
            ->with('layout', 'layouts.admin');
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
} 