<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-semibold text-gray-800">{{ __('Détails du client') }}</h2>
            <div class="flex items-center space-x-4">
                @if(Auth::user()->isAdmin() || Auth::user()->id === $client->id)
                    <a href="{{ route('admin.clients.edit', $client) }}" class="inline-flex items-center px-4 py-2 bg-[#00008f] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#000066] focus:bg-[#000066] active:bg-[#000066] focus:outline-none focus:ring-2 focus:ring-[#00008f] focus:ring-offset-2 transition ease-in-out duration-150">
                        {{ __('Modifier') }}
                    </a>
                @endif
                <a href="{{ route('admin.clients.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                    {{ __('Retour à la liste') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="p-8">
        <div class="space-y-6">
            <!-- Client Information -->
            <div class="bg-white shadow rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Informations du client</h3>
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
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Sinistres du client</h3>
                    @if($client->sinistres->count() > 0)
                        <div class="space-y-4">
                            @foreach($client->sinistres as $sinistre)
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
                                            {{ ucfirst(str_replace('_', ' ', $sinistre->status)) }}
                                        </span>
                                    </div>
                                    <p class="mt-2 text-sm">{{ $sinistre->description }}</p>
                                    @if(Auth::user()->isAdmin())
                                    <div class="mt-2">
                                        <a href="{{ route('admin.sinistres.show', $sinistre) }}" 
                                           class="text-[#00008f] hover:text-[#000066] text-sm font-medium">
                                            Voir les détails →
                                        </a>
                                    </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500">Aucun sinistre enregistré pour ce client.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 