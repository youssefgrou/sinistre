@extends('admin.layouts.app')

@section('title', 'Détails du sinistre')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-2xl font-semibold text-gray-800">{{ __('Détails du sinistre') }} - {{ $sinistre->numero_sinistre }}</h2>
        <a href="{{ route('admin.sinistres.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
            {{ __('Retour à la liste') }}
        </a>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Top Grid: Client Info, Status Summary, and Sinistre Management -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <!-- Informations du client -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-medium text-gray-900">Informations du client</h3>
                            <span class="inline-flex items-center rounded-md bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10">
                                Client
                            </span>
                        </div>
                        <div class="space-y-3">
                            <div class="flex items-center space-x-2">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">{{ $sinistre->user->name }}</p>
                                    {{-- <p class="text-sm text-gray-500 truncate">ID: {{ $sinistre->user->id }}</p> --}}
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm text-gray-900 truncate">{{ $sinistre->user->email }}</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                <div class="flex-1 min-w-0">
                                    @php
                                        $user = $sinistre->user()->first();
                                    @endphp
                                    <p class="text-sm text-gray-900 truncate">{{ $user->phone }}</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm text-gray-900 truncate">{{ $user->address }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Status Summary -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-medium text-gray-900">Statut actuel</h3>
                            <span class="px-2 py-1 text-xs font-medium rounded-full
                                @if($sinistre->status === 'en_attente') bg-yellow-100 text-yellow-800
                                @elseif($sinistre->status === 'en_cours') bg-blue-100 text-blue-800
                                @elseif($sinistre->status === 'expertise') bg-purple-100 text-purple-800
                                @elseif($sinistre->status === 'validé') bg-green-100 text-green-800
                                @elseif($sinistre->status === 'refusé') bg-red-100 text-red-800
                                @endif">
                                {{ ucfirst(str_replace('_', ' ', $sinistre->status)) }}
                            </span>
                        </div>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-500">Date de création</span>
                                <span class="text-gray-900">{{ $sinistre->created_at->format('d/m/Y') }}</span>
                            </div>
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-500">Dernière mise à jour</span>
                                <span class="text-gray-900">{{ $sinistre->updated_at->format('d/m/Y H:i') }}</span>
                            </div>
                            @if($sinistre->payments->isNotEmpty())
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-500">Total des paiements</span>
                                <span class="font-medium text-gray-900">{{ number_format($sinistre->payments->sum('amount'), 2) }} MAD</span>
                            </div>
                            @endif
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-500">Numéro de dossier</span>
                                <span class="text-gray-900">{{ $sinistre->numero_sinistre }}</span>
                            </div>
                        </div>
                </div>
            </div>

            <!-- Statut et mise à jour -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Gestion du sinistre</h3>
                        <form method="POST" action="{{ route('admin.sinistres.update', $sinistre) }}" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="status" :value="__('Statut')" />
                            <select id="status" name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="en_attente" {{ $sinistre->status === 'en_attente' ? 'selected' : '' }}>En attente</option>
                                <option value="en_cours" {{ $sinistre->status === 'en_cours' ? 'selected' : '' }}>En cours de traitement</option>
                                <option value="expertise" {{ $sinistre->status === 'expertise' ? 'selected' : '' }}>En expertise</option>
                                <option value="validé" {{ $sinistre->status === 'validé' ? 'selected' : '' }}>Validé</option>
                                <option value="refusé" {{ $sinistre->status === 'refusé' ? 'selected' : '' }}>Refusé</option>
                            </select>
                        </div>

                        <div>
                            <x-input-label for="commentaire_admin" :value="__('Commentaire administratif')" />
                                <textarea id="commentaire_admin" name="commentaire_admin" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ $sinistre->commentaire_admin }}</textarea>
                                <p class="mt-1 text-xs text-gray-500">Ce commentaire sera visible par le client.</p>
                        </div>

                        <div class="flex justify-end">
                            <x-primary-button>
                                {{ __('Mettre à jour') }}
                            </x-primary-button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>

            <!-- Vehicle and Sinistre Info Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Informations du véhicule -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Informations du véhicule</h3>
                        <dl class="grid grid-cols-1 gap-4">
                            <div class="sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-500">Immatriculation</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $sinistre->immatriculation }}</dd>
                            </div>
                            <div class="sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-500">Marque</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $sinistre->marque }}</dd>
                            </div>
                            <div class="sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-500">Modèle</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $sinistre->modele }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <!-- Informations du sinistre -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Informations du sinistre</h3>
                        <dl class="grid grid-cols-1 gap-4">
                            <div class="sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-500">Date</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $sinistre->date_sinistre->format('d/m/Y') }}</dd>
                            </div>
                            <div class="sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-500">Heure</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $sinistre->heure_sinistre }}</dd>
                            </div>
                            <div class="sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-500">Type</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
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
                                </dd>
                            </div>
                            <div class="sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-500">Lieu</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $sinistre->lieu_sinistre }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>

            <!-- Description et circonstances -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Description et circonstances</h3>
                    <div class="space-y-6">
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 mb-2">Description des dommages</h4>
                            <p class="text-sm text-gray-900 bg-gray-50 rounded-lg p-4">{{ $sinistre->description }}</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 mb-2">Circonstances</h4>
                            <p class="text-sm text-gray-900 bg-gray-50 rounded-lg p-4">{{ $sinistre->circonstances }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Documents -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Documents justificatifs</h3>
                    @if($sinistre->documents->isEmpty())
                        <p class="text-sm text-gray-500">Aucun document n'a été téléchargé pour ce sinistre.</p>
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                            @foreach($sinistre->documents as $document)
                                <div class="relative group">
                                    <a href="{{ Storage::url($document->chemin_fichier) }}" target="_blank" class="block p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                                        <div class="flex items-center">
                                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                            </svg>
                                            <span class="ml-2 text-sm text-gray-600 truncate">{{ $document->nom }}</span>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <!-- Payment History -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-900">Historique des paiements</h3>
                        <div class="flex items-center space-x-4">
                            <span class="text-sm text-gray-600">
                                Total des paiements: 
                                <span class="font-semibold">{{ number_format($sinistre->payments->sum('amount'), 2) }} MAD</span>
                            </span>
                        </div>
                    </div>
                    
                    @if($sinistre->payments->isEmpty())
                        <p class="text-sm text-gray-500">Aucun paiement n'a été effectué pour le moment.</p>
                    @else
                        <div class="mt-4">
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Montant</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Méthode</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($sinistre->payments as $payment)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {{ $payment->created_at->format('d/m/Y H:i') }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {{ $payment->user->name }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {{ number_format($payment->amount, 2) }} MAD
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                        @if($payment->status === 'completed') bg-green-100 text-green-800
                                                        @elseif($payment->status === 'pending') bg-yellow-100 text-yellow-800
                                                        @else bg-gray-100 text-gray-800
                                                        @endif">
                                                        {{ ucfirst($payment->status) }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {{ ucfirst($payment->payment_method) }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    @if($payment->status === 'pending')
                                                        <form action="{{ route('admin.payments.update', $payment) }}" method="POST" class="inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" 
                                                                class="text-green-600 hover:text-green-900 mr-3">
                                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            @if($sinistre->commentaire_admin)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Commentaire administratif</h3>
                    <p class="text-sm text-gray-900 bg-gray-50 rounded-lg p-4">{{ $sinistre->commentaire_admin }}</p>
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection 