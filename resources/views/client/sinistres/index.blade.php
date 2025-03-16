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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <!-- Search Bar -->
            <div class="relative">
                <form action="{{ route('client.sinistres.index') }}" method="GET" class="flex items-center space-x-4">
                    <div class="flex-1 relative">
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Rechercher par numéro, immatriculation, marque..."
                            class="w-full pl-14 pr-4 py-4 rounded-2xl border-0 bg-white shadow-lg focus:ring-2 focus:ring-[#00008f] focus:ring-opacity-20 transition-all duration-200 text-gray-700"
                        >
                        <div class="absolute left-5 top-1/2 transform -translate-y-1/2 text-gray-400">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>
                    @if(request('search'))
                        <a href="{{ route('client.sinistres.index') }}" 
                           class="inline-flex items-center px-6 py-4 bg-gray-50 rounded-2xl text-sm font-medium text-gray-600 hover:bg-gray-100 hover:shadow-md transition-all duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Réinitialiser
                        </a>
                    @endif
                </form>
            </div>

            <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
                <div class="p-8">
                    @if($sinistres->isEmpty())
                        <div class="text-center py-16">
                            <div class="bg-gray-50 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-6">
                                <svg class="w-10 h-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">
                                @if(request('search'))
                                    Aucun résultat trouvé pour "{{ request('search') }}"
                                @else
                                    Aucun sinistre
                                @endif
                            </h3>
                            <p class="text-gray-500 mb-8">
                                @if(request('search'))
                                    Essayez avec d'autres termes de recherche.
                                @else
                                    Commencez par déclarer un sinistre.
                                @endif
                            </p>
                            <div>
                                @if(request('search'))
                                    <a href="{{ route('client.sinistres.index') }}" class="inline-flex items-center px-6 py-3 bg-gray-50 rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-100 transition-all duration-200">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                        Réinitialiser la recherche
                                    </a>
                                @else
                                    <a href="{{ route('client.sinistres.create') }}" class="inline-flex items-center px-6 py-3 bg-[#00008f] rounded-xl text-sm font-medium text-white hover:bg-[#000066] transition-all duration-200 shadow-md hover:shadow-xl">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                        </svg>
                                        Déclarer un sinistre
                                    </a>
                                @endif
                            </div>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full">
                                <thead>
                                    <tr class="border-b border-gray-100">
                                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">N° Sinistre</th>
                                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Véhicule</th>
                                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-50">
                                    @foreach($sinistres as $sinistre)
                                        <tr class="hover:bg-gray-50/50 transition-colors duration-200">
                                            <td class="px-6 py-5 whitespace-nowrap">
                                                <a href="{{ route('client.sinistres.show', $sinistre) }}" class="text-[#00008f] hover:text-[#000066] font-semibold hover:underline transition-colors duration-200">
                                                    {{ $sinistre->numero_sinistre }}
                                                </a>
                                            </td>
                                            <td class="px-6 py-5">
                                                <div class="flex flex-col">
                                                    <span class="text-sm font-medium text-gray-900">{{ $sinistre->marque }} {{ $sinistre->modele }}</span>
                                                    <span class="text-xs text-gray-500 mt-0.5">{{ $sinistre->immatriculation }}</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-5">
                                                <div class="flex flex-col">
                                                    <span class="text-sm font-medium text-gray-900">{{ $sinistre->date_sinistre->format('d/m/Y') }}</span>
                                                    <span class="text-xs text-gray-500 mt-0.5">{{ $sinistre->heure_sinistre }}</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-5">
                                                <span class="text-sm text-gray-900">
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
                                                </span>
                                            </td>
                                            <td class="px-6 py-5">
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                                    @if($sinistre->status === 'en_cours') bg-yellow-50 text-yellow-700
                                                    @elseif($sinistre->status === 'validé') bg-green-50 text-green-700
                                                    @elseif($sinistre->status === 'refusé') bg-red-50 text-red-700
                                                    @else bg-gray-50 text-gray-700
                                                    @endif">
                                                    @if($sinistre->status === 'en_cours')
                                                        <svg class="w-4 h-4 mr-1.5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                    @elseif($sinistre->status === 'validé')
                                                        <svg class="w-4 h-4 mr-1.5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                        </svg>
                                                    @elseif($sinistre->status === 'refusé')
                                                        <svg class="w-4 h-4 mr-1.5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    @endif
                                                    {{ ucfirst(str_replace('_', ' ', $sinistre->status)) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-6">
                            {{ $sinistres->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 