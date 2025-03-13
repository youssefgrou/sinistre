<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::with('user')->paginate(10);
        return view('admin.clients.index', compact('clients'));
    }

    public function show(Client $client)
    {
        $client->load(['user.sinistres']);
        return view('admin.clients.show', compact('client'));
    }

    public function edit(Client $client)
    {
        return view('admin.clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($client->user->id)],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:255'],
        ]);

        $client->user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        $client->update([
            'phone' => $validated['phone'],
            'address' => $validated['address'],
        ]);

        return redirect()
            ->route('admin.clients.show', $client)
            ->with('success', 'Les informations du client ont été mises à jour avec succès.');
    }

    public function destroy(Client $client)
    {
        $client->user->delete(); // This will cascade delete the client due to foreign key constraint
        return redirect()
            ->route('admin.clients.index')
            ->with('success', 'Le client a été supprimé avec succès.');
    }
} 