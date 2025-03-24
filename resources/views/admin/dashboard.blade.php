<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold text-gray-800">Tableau de bord administrateur</h1>
    </x-slot>

    <!-- Main Cards -->
    <div class="p-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Sinistres Card -->
            <a href="{{ route('admin.sinistres.index') }}" class="bg-white rounded-xl p-6 hover:shadow-lg transition-all duration-200">
                <div class="flex items-center space-x-4 mb-4">
                    <div class="bg-blue-50 rounded-lg p-3">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-medium text-gray-800">Sinistres</h2>
                        <p class="text-sm text-gray-500">Gérer les sinistres</p>
                    </div>
                </div>
                <div class="flex justify-between items-end">
                    <div>
                        <p class="text-2xl font-bold text-gray-800">{{ $totalClaims }}</p>
                        <p class="text-sm text-gray-500">Total</p>
                    </div>
                    <div class="text-blue-600">→</div>
                </div>
            </a>

            <!-- Clients Card -->
            <a href="{{ route('admin.clients.index') }}" class="bg-white rounded-xl p-6 hover:shadow-lg transition-all duration-200">
                <div class="flex items-center space-x-4 mb-4">
                    <div class="bg-green-50 rounded-lg p-3">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-medium text-gray-800">Clients</h2>
                        <p class="text-sm text-gray-500">Gérer les utilisateurs</p>
                    </div>
                </div>
                <div class="flex justify-between items-end">
                    <div>
                        <p class="text-2xl font-bold text-gray-800">{{ $totalClients }}</p>
                        <p class="text-sm text-gray-500">Total</p>
                    </div>
                    <div class="text-green-600">→</div>
                </div>
            </a>

            <!-- Rapports Card -->
            <a href="#" class="bg-white rounded-xl p-6 hover:shadow-lg transition-all duration-200">
                <div class="flex items-center space-x-4 mb-4">
                    <div class="bg-purple-50 rounded-lg p-3">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-medium text-gray-800">Rapports</h2>
                        <p class="text-sm text-gray-500">Statistiques et analyses</p>
                    </div>
                </div>
                <div class="flex justify-between items-end">
                    <div>
                        <p class="text-2xl font-bold text-gray-800">{{ $activeClaims }}</p>
                        <p class="text-sm text-gray-500">En cours</p>
                    </div>
                    <div class="text-purple-600">→</div>
                </div>
            </a>
        </div>

        <!-- Actions rapides -->
        <div class="mb-8">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Actions rapides</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Gestion des sinistres -->
                <a href="{{ route('admin.sinistres.index') }}" class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition-all duration-200 group">
                    <div class="flex items-center space-x-4">
                        <div class="bg-blue-50 rounded-lg p-3 group-hover:bg-blue-100 transition-colors duration-200">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-medium text-gray-800">Gestion des sinistres</h3>
                            <p class="text-sm text-gray-500">Voir et gérer les déclarations de sinistres</p>
                        </div>
                    </div>
                </a>

                <!-- Gestion des clients -->
                <a href="{{ route('admin.clients.index') }}" class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition-all duration-200 group">
                    <div class="flex items-center space-x-4">
                        <div class="bg-green-50 rounded-lg p-3 group-hover:bg-green-100 transition-colors duration-200">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-medium text-gray-800">Gestion des clients</h3>
                            <p class="text-sm text-gray-500">Gérer les comptes utilisateurs</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Latest Claims Section -->
        <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-semibold text-gray-800">Dernier sinistre reçu</h2>
                <a href="{{ route('admin.sinistres.index') }}" class="text-blue-600 hover:text-blue-700 text-sm font-medium">
                    Voir tous les sinistres →
                </a>
            </div>

            @if($latestClaim)
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
                        <div>
                            <p class="text-sm text-gray-500">Numéro de sinistre</p>
                            <p class="font-medium text-gray-800">#{{ $latestClaim->numero_sinistre }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Date</p>
                            <p class="font-medium text-gray-800">{{ $latestClaim->date_sinistre->format('d/m/Y') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Client</p>
                            <p class="font-medium text-gray-800">{{ $latestClaim->user->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Statut</p>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                @switch($latestClaim->status)
                                    @case('en_cours')
                                        bg-yellow-100 text-yellow-800
                                        @break
                                    @case('traité')
                                        bg-green-100 text-green-800
                                        @break
                                    @default
                                        bg-gray-100 text-gray-800
                                @endswitch
                            ">
                                {{ ucfirst($latestClaim->status) }}
                            </span>
                        </div>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Description</p>
                        <p class="mt-1 text-gray-700">{{ $latestClaim->description }}</p>
                    </div>
                </div>
            @else
                <div class="text-center py-8">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                    <p class="mt-2 text-sm text-gray-500">Aucun sinistre disponible</p>
                </div>
            @endif
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Recent Claims -->
            <div class="bg-white rounded-xl p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-lg font-semibold text-gray-800">Sinistres récents</h2>
                    <a href="{{ route('admin.sinistres.index') }}" class="text-blue-600 hover:text-blue-700">
                        Voir tout →
                    </a>
                </div>
                <div class="space-y-4">
                    @foreach($recentClaims as $claim)
                        <div class="flex items-center justify-between hover:bg-gray-50 rounded-lg p-3">
                            <div class="flex items-center space-x-3">
                                <div class="bg-blue-50 rounded-full p-2">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800">Sinistre #{{ $claim->numero_sinistre }}</p>
                                    <p class="text-sm text-gray-500">{{ $claim->date_sinistre->format('d/m/Y') }}</p>
                                </div>
                            </div>
                            <span class="px-3 py-1 text-xs rounded-full {{ $claim->status === 'en_attente' ? 'bg-gray-100 text-gray-800' : ($claim->status === 'expertise' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800') }}">
                                {{ ucfirst($claim->status) }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Recent Clients -->
            <div class="bg-white rounded-xl p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-lg font-semibold text-gray-800">Clients récents</h2>
                    <a href="{{ route('admin.clients.index') }}" class="text-green-600 hover:text-green-700">
                        Voir tout →
                    </a>
                </div>
                <div class="space-y-4">
                    @foreach($recentClients as $client)
                        <div class="flex items-center justify-between hover:bg-gray-50 rounded-lg p-3">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 rounded-full bg-green-50 flex items-center justify-center">
                                    <span class="text-sm font-medium text-green-600">
                                        {{ strtoupper(substr($client->name, 0, 2)) }}
                                    </span>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800">{{ $client->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $client->email }}</p>
                                </div>
                            </div>
                            <a href="{{ route('admin.clients.show', $client) }}" class="text-gray-400 hover:text-gray-600">
                                →
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
