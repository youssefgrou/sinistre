@extends('admin.layouts.app')

@section('title', 'Détails du client')

@section('content')
    <div class="space-y-6">
        <!-- Client Information -->
        <div class="bg-white shadow rounded-lg">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold">Informations du client</h2>
                    <a href="{{ route('admin.clients.edit', $client) }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                        Modifier
                    </a>
                </div>

                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <p class="text-sm text-gray-500">Nom</p>
                        <p class="font-medium">{{ $client->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Email</p>
                        <p class="font-medium">{{ $client->email }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Téléphone</p>
                        <p class="font-medium">{{ $client->phone ?? 'Non renseigné' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Adresse</p>
                        <p class="font-medium">{{ $client->address ?? 'Non renseignée' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Client's Claims -->
        <div class="bg-white shadow rounded-lg">
            <div class="p-6">
                <h2 class="text-xl font-semibold mb-4">Sinistres du client</h2>

                @if($client->user->sinistres->count() > 0)
                    <div class="space-y-4">
                        @foreach($client->user->sinistres as $sinistre)
                            <div class="border-b pb-4">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="font-medium">Sinistre #{{ $sinistre->numero_sinistre }}</p>
                                        <p class="text-sm text-gray-600">{{ $sinistre->date_sinistre->format('d/m/Y') }}</p>
                                        <p class="text-sm text-gray-600">Type: {{ $sinistre->type_sinistre }}</p>
                                    </div>
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full
                                        @if($sinistre->status === 'en_cours') bg-yellow-100 text-yellow-800
                                        @elseif($sinistre->status === 'validé') bg-green-100 text-green-800
                                        @elseif($sinistre->status === 'refusé') bg-red-100 text-red-800
                                        @else bg-gray-100 text-gray-800
                                        @endif">
                                        {{ $sinistre->status }}
                                    </span>
                                </div>
                                <p class="mt-2 text-sm">{{ $sinistre->description }}</p>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500">Aucun sinistre enregistré pour ce client.</p>
                @endif
            </div>
        </div>
    </div>
@endsection 