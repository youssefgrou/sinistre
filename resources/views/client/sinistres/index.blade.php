<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Mes sinistres') }}
            </h2>
            <a href="{{ route('client.sinistres.create') }}" class="inline-flex items-center px-4 py-2 bg-[#00008f] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#000066] focus:bg-[#000066] active:bg-[#000066] focus:outline-none focus:ring-2 focus:ring-[#00008f] focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Déclarer un sinistre') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Search Bar -->
            <div class="mb-6">
                <form action="{{ route('client.sinistres.index') }}" method="GET" class="flex items-center space-x-4">
                    <div class="flex-1 relative">
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Rechercher par numéro, immatriculation, marque..."
                            class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-200 focus:border-[#00008f] focus:ring focus:ring-[#00008f] focus:ring-opacity-20 transition-all duration-200"
                        >
                        <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>
                    @if(request('search'))
                        <a href="{{ route('client.sinistres.index') }}" 
                           class="inline-flex items-center px-4 py-3 bg-gray-100 border border-transparent rounded-xl text-sm font-medium text-gray-600 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-all duration-200">
                            <svg class="w-5 h-5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Réinitialiser
                        </a>
                    @endif
                </form>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if($sinistres->isEmpty())
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">
                                @if(request('search'))
                                    Aucun résultat trouvé pour "{{ request('search') }}"
                                @else
                                    Aucun sinistre
                                @endif
                            </h3>
                            <p class="mt-1 text-sm text-gray-500">
                                @if(request('search'))
                                    Essayez avec d'autres termes de recherche.
                                @else
                                    Commencez par déclarer un sinistre.
                                @endif
                            </p>
                            <div class="mt-6">
                                @if(request('search'))
                                    <a href="{{ route('client.sinistres.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-gray-700 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                        Réinitialiser la recherche
                                    </a>
                                @else
                                    <a href="{{ route('client.sinistres.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-[#00008f] hover:bg-[#000066] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#00008f]">
                                        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                                        </svg>
                                        Déclarer un sinistre
                                    </a>
                                @endif
                            </div>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">N° Sinistre</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Véhicule</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($sinistres as $sinistre)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $sinistre->numero_sinistre }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $sinistre->marque }} {{ $sinistre->modele }}<br>
                                                <span class="text-xs text-gray-400">{{ $sinistre->immatriculation }}</span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $sinistre->date_sinistre->format('d/m/Y') }}<br>
                                                <span class="text-xs text-gray-400">{{ $sinistre->heure_sinistre }}</span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                @php
                                                    $typesSinistres = [
                                                        'vol_tentative_vol' => 'Vol et tentative de vol',
                                                        'vandalisme_degradations' => 'Vandalisme et dégradations volontaires',
                                                        'incendie_explosion' => 'Incendie et explosion',
                                                        'bris_glaces' => 'Bris de glaces',
                                                        'collision_route' => 'Collission de la Route'
                                                    ];
                                                @endphp
                                                {{ $typesSinistres[$sinistre->type_sinistre] ?? ucfirst(str_replace('_', ' ', $sinistre->type_sinistre)) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 py-1 text-xs font-semibold rounded-full
                                                    @if($sinistre->status === 'en_cours') bg-yellow-100 text-yellow-800
                                                    @elseif($sinistre->status === 'validé') bg-green-100 text-green-800
                                                    @elseif($sinistre->status === 'refusé') bg-red-100 text-red-800
                                                    @else bg-gray-100 text-gray-800
                                                    @endif">
                                                    {{ ucfirst(str_replace('_', ' ', $sinistre->status)) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                <div class="flex items-center space-x-3">
                                                    <a href="{{ route('client.sinistres.show', $sinistre) }}" class="text-[#00008f] hover:text-[#000066]">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                        </svg>
                                                    </a>
                                                    {{-- <a href="{{ route('client.sinistres.print', $sinistre) }}" class="text-[#00008f] hover:text-[#000066]" title="Imprimer">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                                                        </svg>
                                                    </a> --}}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            {{ $sinistres->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 