<x-app-layout>
    {{-- <x-slot name="header">
        <div class="bg-gradient-to-r from-[#00008f] to-[#000066] -mt-6 -mx-4 px-4 py-8 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-white">
                {{ __('Espace Client') }}
            </h2>
        </div>
    </x-slot> --}}

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Bannière principale -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-6 transform transition-all duration-300 hover:shadow-xl">
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-50 to-indigo-50 opacity-50"></div>
                    <div class="relative p-8">
                        <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
                            <div class="text-center md:text-left">
                                <h2 class="text-3xl font-bold text-gray-900 mb-2">Bienvenue, {{ auth()->user()->name }}</h2>
                                <p class="text-lg text-gray-600">Nous sommes là pour vous accompagner</p>
                            </div>
                            <div class="flex space-x-4">
                                <a href="{{ route('client.sinistres.create') }}" 
                                   class="group inline-flex items-center px-6 py-3 bg-[#00008f] text-base font-medium rounded-xl text-white shadow-lg hover:bg-[#000066] transform transition-all duration-300 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#00008f]">
                                    <svg class="w-5 h-5 mr-2 transform transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    {{ __('Déclarer un sinistre') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions principales -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Carte Déclarer un sinistre -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition-all duration-300 hover:shadow-xl hover:scale-[1.02]">
                    <div class="p-6">
                        <div class="flex items-center mb-6">
                            <div class="p-4 rounded-xl bg-blue-100 text-blue-600">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                            <h3 class="ml-4 text-xl font-semibold text-gray-900">Déclarer un sinistre</h3>
                        </div>
                        <p class="text-gray-600 mb-6 text-lg">Signalez un nouveau sinistre automobile et suivez son traitement en temps réel.</p>
                        <a href="{{ route('client.sinistres.create') }}" 
                           class="group w-full inline-flex items-center justify-center px-4 py-3 bg-[#00008f] text-base font-medium rounded-xl text-white shadow-md hover:bg-[#000066] transform transition-all duration-300 hover:shadow-lg">
                            <span>Commencer la déclaration</span>
                            <svg class="ml-2 w-5 h-5 transform transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Carte Suivre mes sinistres -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition-all duration-300 hover:shadow-xl hover:scale-[1.02]">
                    <div class="p-6">
                        <div class="flex items-center mb-6">
                            <div class="p-4 rounded-xl bg-green-100 text-green-600">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h3 class="ml-4 text-xl font-semibold text-gray-900">Suivre mes sinistres</h3>
                        </div>
                        <p class="text-gray-600 mb-6 text-lg">Consultez l'état d'avancement de vos déclarations et gérez vos documents.</p>
                        <a href="{{ route('client.sinistres.index') }}" 
                           class="group w-full inline-flex items-center justify-center px-4 py-3 bg-white border-2 border-gray-200 text-base font-medium rounded-xl text-gray-700 shadow-md hover:bg-gray-50 transform transition-all duration-300 hover:shadow-lg">
                            <span>Voir mes sinistres</span>
                            <svg class="ml-2 w-5 h-5 transform transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Derniers sinistres -->
            @if(!$derniersSinistres->isEmpty())
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-semibold text-gray-900">Mes dernières déclarations</h3>
                        <a href="{{ route('client.sinistres.index') }}" class="text-[#00008f] hover:text-[#000066] font-medium flex items-center">
                            Voir tout
                            <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">N° Sinistre</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($derniersSinistres as $sinistre)
                                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $sinistre->numero_sinistre }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $sinistre->date_sinistre->format('d/m/Y') }}
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
                                            {{ $typesSinistres[$sinistre->type_sinistre] }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full 
                                                @if($sinistre->status === 'en_attente') bg-yellow-100 text-yellow-800
                                                @elseif($sinistre->status === 'en_cours') bg-blue-100 text-blue-800
                                                @elseif($sinistre->status === 'expertise') bg-purple-100 text-purple-800
                                                @elseif($sinistre->status === 'validé') bg-green-100 text-green-800
                                                @elseif($sinistre->status === 'refusé') bg-red-100 text-red-800
                                                @endif">
                                                {{ ucfirst(str_replace('_', ' ', $sinistre->status)) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <a href="{{ route('client.sinistres.show', $sinistre) }}" 
                                               class="text-[#00008f] hover:text-[#000066] font-medium flex items-center">
                                                Voir les détails
                                                <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
