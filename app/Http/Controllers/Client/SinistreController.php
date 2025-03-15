<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Sinistre;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;

class SinistreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sinistres = auth()->user()->sinistres()->latest()->paginate(10);
        return view('client.sinistres.index', compact('sinistres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('client.sinistres.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'immatriculation' => 'required|string|max:20',
            'marque' => 'required|string|max:50',
            'modele' => 'required|string|max:50',
            'date_sinistre' => 'required|date',
            'heure_sinistre' => 'required',
            'lieu_sinistre' => 'required|string',
            'type_sinistre' => 'required|in:vol_tentative_vol,vandalisme_degradations,incendie_explosion,bris_glaces,collision_route',
            'description' => 'required|string',
            'circonstances' => 'required|string',
            'documents.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:10240'
        ]);

        // Get the latest sinistre number and increment it
        $latestSinistre = Sinistre::latest()->first();
        $latestNumber = $latestSinistre ? intval(substr($latestSinistre->numero_sinistre, 4)) : 0;
        $nextNumber = $latestNumber + 1;
        $numeroSinistre = 'SIN-' . str_pad($nextNumber, 6, '0', STR_PAD_LEFT);

        $sinistre = auth()->user()->sinistres()->create([
            'numero_sinistre' => $numeroSinistre,
            'immatriculation' => $validated['immatriculation'],
            'marque' => $validated['marque'],
            'modele' => $validated['modele'],
            'date_sinistre' => $validated['date_sinistre'],
            'heure_sinistre' => $validated['heure_sinistre'],
            'lieu_sinistre' => $validated['lieu_sinistre'],
            'type_sinistre' => $validated['type_sinistre'],
            'description' => $validated['description'],
            'circonstances' => $validated['circonstances'],
            'status' => 'en_attente'
        ]);

        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                $path = $file->store('documents/sinistres/' . $sinistre->id, 'public');
                
                Document::create([
                    'sinistre_id' => $sinistre->id,
                    'nom' => $file->getClientOriginalName(),
                    'type_document' => $file->getClientOriginalExtension(),
                    'chemin_fichier' => $path,
                    'taille_fichier' => $file->getSize(),
                    'type_mime' => $file->getMimeType()
                ]);
            }
        }

        return redirect()->route('client.sinistres.index')
            ->with('success', 'Votre déclaration de sinistre a été enregistrée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sinistre $sinistre)
    {
        // Check if the current user owns this sinistre or is an admin
        if ($sinistre->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403, 'Vous n\'êtes pas autorisé à voir cette déclaration.');
        }

        return view('client.sinistres.show', compact('sinistre'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function uploadDocuments(Request $request, Sinistre $sinistre)
    {
        if (!Gate::allows('update-sinistre', $sinistre)) {
            abort(403, 'Vous n\'êtes pas autorisé à modifier cette déclaration.');
        }
        
        $request->validate([
            'documents.*' => 'required|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:10240'
        ]);

        foreach ($request->file('documents') as $file) {
            $path = $file->store('documents/sinistres/' . $sinistre->id, 'public');
            
            Document::create([
                'sinistre_id' => $sinistre->id,
                'nom' => $file->getClientOriginalName(),
                'type_document' => $file->getClientOriginalExtension(),
                'chemin_fichier' => $path,
                'taille_fichier' => $file->getSize(),
                'type_mime' => $file->getMimeType()
            ]);
        }

        return back()->with('success', 'Les documents ont été téléchargés avec succès.');
    }
}
