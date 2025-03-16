<x-app-layout>
    

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Bannière principale avec effet glassmorphism -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-4 transform transition-all duration-300 hover:shadow-xl relative">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-50/90 via-indigo-50/80 to-white/70 backdrop-blur-sm"></div>
                <div class="relative p-6">
                    <div class="flex flex-col md:flex-row items-center justify-between space-y-4 md:space-y-0">
                        <div class="text-center md:text-left">
                            <span class="inline-block px-3 py-0.5 rounded-full bg-blue-50 text-[#00008f] text-sm font-medium mb-2">Espace Client</span>
                            <h2 class="text-2xl font-bold text-gray-900 mb-1">Bienvenue, {{ auth()->user()->name }}</h2>
                            <p class="text-base text-gray-600">Nous sommes là pour vous accompagner</p>
                        </div>
                        <div class="flex space-x-4">
                            <a href="{{ route('client.sinistres.create') }}" 
                               class="group inline-flex items-center px-4 py-2 bg-[#00008f] text-sm font-medium rounded-lg text-white shadow-md hover:bg-[#000066] transform transition-all duration-300 hover:scale-105 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#00008f]">
                                <svg class="w-4 h-4 mr-2 transform transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                {{ __('Déclarer un sinistre') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions principales avec nouvelles cartes -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <!-- Carte Déclarer un sinistre -->
                <div class="group bg-white rounded-xl shadow-lg overflow-hidden transform transition-all duration-300 hover:shadow-xl hover:scale-[1.02]">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="p-3 rounded-lg bg-blue-50 text-[#00008f] group-hover:bg-[#00008f] group-hover:text-white transition-colors duration-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                            <h3 class="ml-3 text-lg font-semibold text-gray-900">Déclarer un sinistre</h3>
                        </div>
                        <p class="text-gray-600 mb-4 text-sm">Signalez un nouveau sinistre automobile et suivez son traitement en temps réel.</p>
                        <a href="{{ route('client.sinistres.create') }}" 
                           class="group/btn w-full inline-flex items-center justify-center px-4 py-2 bg-[#00008f] text-sm font-medium rounded-lg text-white shadow-md hover:bg-[#000066] transform transition-all duration-300 hover:shadow-lg">
                            <span>Commencer la déclaration</span>
                            <svg class="ml-2 w-4 h-4 transform transition-transform group-hover/btn:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Carte Suivre mes sinistres -->
                <div class="group bg-white rounded-xl shadow-lg overflow-hidden transform transition-all duration-300 hover:shadow-xl hover:scale-[1.02]">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="p-3 rounded-lg bg-green-50 text-green-600 group-hover:bg-green-600 group-hover:text-white transition-colors duration-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h3 class="ml-3 text-lg font-semibold text-gray-900">Suivre mes sinistres</h3>
                        </div>
                        <p class="text-gray-600 mb-4 text-sm">Consultez l'état d'avancement de vos déclarations et gérez vos documents.</p>
                        <a href="{{ route('client.sinistres.index') }}" 
                           class="group/btn w-full inline-flex items-center justify-center px-4 py-2 bg-white border-2 border-gray-200 text-sm font-medium rounded-lg text-gray-700 shadow-sm hover:bg-gray-50 transform transition-all duration-300 hover:shadow-md">
                            <span>Voir mes sinistres</span>
                            <svg class="ml-2 w-4 h-4 transform transition-transform group-hover/btn:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Derniers sinistres avec design moderne -->
            @if(!$derniersSinistres->isEmpty())
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Mes dernières déclarations</h3>
                            <p class="text-xs text-gray-500 mt-0.5">Suivez vos derniers sinistres déclarés</p>
                        </div>
                        <a href="{{ route('client.sinistres.index') }}" 
                           class="group inline-flex items-center px-3 py-1.5 rounded-lg bg-gray-50 text-sm font-medium text-gray-700 hover:bg-gray-100 transition-all duration-200">
                            Voir tout
                            <svg class="ml-1.5 w-4 h-4 transform transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead>
                                <tr class="border-b border-gray-100">
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">N° Sinistre</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @foreach($derniersSinistres as $sinistre)
                                    <tr class="group hover:bg-gray-50/50 transition-colors duration-200">
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <span class="text-sm font-medium text-gray-900">{{ $sinistre->numero_sinistre }}</span>
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <span class="text-sm text-gray-500">{{ $sinistre->date_sinistre->format('d/m/Y') }}</span>
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <span class="text-sm text-gray-700">
                                                @php
                                                    $typesSinistres = [
                                                        'vol_tentative_vol' => 'Vol et tentative de vol',
                                                        'vandalisme_degradations' => 'Vandalisme et dégradations volontaires',
                                                        'incendie_explosion' => 'Incendie et explosion',
                                                        'bris_glaces' => 'Bris de glaces',
                                                        'collision_route' => 'Collission de la Route'
                                                    ];
                                                @endphp
                                                {{ $typesSinistres[$sinistre->type_sinistre] }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                @if($sinistre->status === 'en_attente') bg-yellow-50 text-yellow-700
                                                @elseif($sinistre->status === 'en_cours') bg-blue-50 text-blue-700
                                                @elseif($sinistre->status === 'expertise') bg-purple-50 text-purple-700
                                                @elseif($sinistre->status === 'validé') bg-green-50 text-green-700
                                                @elseif($sinistre->status === 'refusé') bg-red-50 text-red-700
                                                @endif">
                                                {{ ucfirst(str_replace('_', ' ', $sinistre->status)) }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <a href="{{ route('client.sinistres.show', $sinistre) }}" 
                                               class="inline-flex items-center text-sm font-medium text-[#00008f] group-hover:text-[#000066] transition-colors duration-200">
                                                Voir les détails
                                                <svg class="ml-1.5 w-4 h-4 transform transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
