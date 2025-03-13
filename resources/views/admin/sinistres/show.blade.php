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
            <!-- Informations du client -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Informations du client</h3>
                    <dl class="grid grid-cols-1 gap-4">
                        <div class="sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm font-medium text-gray-500">Nom</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $sinistre->user->name }}</dd>
                        </div>
                        <div class="sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm font-medium text-gray-500">Email</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $sinistre->user->email }}</dd>
                        </div>
                    </dl>
                </div>
            </div>

            <!-- Statut et mise à jour -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Gestion du sinistre</h3>
                    <form method="POST" action="{{ route('admin.sinistres.update', $sinistre) }}" class="space-y-6">
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
                            <textarea id="commentaire_admin" name="commentaire_admin" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ $sinistre->commentaire_admin }}</textarea>
                            <p class="mt-2 text-sm text-gray-500">Ce commentaire sera visible par le client.</p>
                        </div>

                        <div class="flex justify-end">
                            <x-primary-button>
                                {{ __('Mettre à jour') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>

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
        </div>
    </div>
@endsection 