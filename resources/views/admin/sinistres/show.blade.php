<x-app-layout>
    <x-slot name="header">
        <div class="mb-6 flex justify-between items-center">
            <h2 class="text-2xl font-semibold text-gray-800">{{ __('Détails du sinistre') }} - {{ $sinistre->numero_sinistre }}</h2>
            <a href="{{ route('admin.sinistres.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                {{ __('Retour à la liste') }}
            </a>
        </div>
    </x-slot>

    <div class="p-8">
        <div class="max-w-7xl mx-auto">
            <!-- Top Grid: Client Info, Status Summary, and Sinistre Management -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Client Information -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Informations du client</h3>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-500">Nom</span>
                                <span class="text-gray-900">{{ $sinistre->user->name }}</span>
                            </div>
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-500">Email</span>
                                <span class="text-gray-900">{{ $sinistre->user->email }}</span>
                            </div>
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-500">Téléphone</span>
                                <span class="text-gray-900">{{ $sinistre->user->phone ?: 'Non renseigné' }}</span>
                            </div>
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-500">Adresse</span>
                                <span class="text-gray-900">{{ $sinistre->user->address ?: 'Non renseignée' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Status Summary -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">État du sinistre</h3>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-500">Statut actuel</span>
                                <span class="px-2 py-1 text-xs font-semibold rounded-full
                                    @if($sinistre->status === 'en_attente') bg-yellow-100 text-yellow-800
                                    @elseif($sinistre->status === 'en_cours') bg-blue-100 text-blue-800
                                    @elseif($sinistre->status === 'expertise') bg-purple-100 text-purple-800
                                    @elseif($sinistre->status === 'validé') bg-green-100 text-green-800
                                    @elseif($sinistre->status === 'refusé') bg-red-100 text-red-800
                                    @endif">
                                    {{ ucfirst(str_replace('_', ' ', $sinistre->status)) }}
                                </span>
                            </div>
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

                <!-- Sinistre Management -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Gestion du sinistre</h3>
                        <form action="{{ route('admin.sinistres.update', $sinistre) }}" method="POST" class="space-y-4">
                            @csrf
                            @method('PATCH')
                            
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700">Changer le statut</label>
                                <select name="status" id="status" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-[#00008f] focus:border-[#00008f] sm:text-sm rounded-md">
                                    <option value="en_attente" {{ $sinistre->status === 'en_attente' ? 'selected' : '' }}>En attente</option>
                                    <option value="en_cours" {{ $sinistre->status === 'en_cours' ? 'selected' : '' }}>En cours</option>
                                    <option value="expertise" {{ $sinistre->status === 'expertise' ? 'selected' : '' }}>Expertise</option>
                                    <option value="validé" {{ $sinistre->status === 'validé' ? 'selected' : '' }}>Validé</option>
                                    <option value="refusé" {{ $sinistre->status === 'refusé' ? 'selected' : '' }}>Refusé</option>
                                </select>
                            </div>

                            <div>
                                <label for="commentaire_admin" class="block text-sm font-medium text-gray-700">Commentaire administratif</label>
                                <textarea name="commentaire_admin" id="commentaire_admin" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#00008f] focus:ring focus:ring-[#00008f] focus:ring-opacity-50 sm:text-sm">{{ $sinistre->commentaire_admin }}</textarea>
                            </div>

                            <div class="flex justify-end">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-[#00008f] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#000066] focus:bg-[#000066] active:bg-[#000066] focus:outline-none focus:ring-2 focus:ring-[#00008f] focus:ring-offset-2 transition ease-in-out duration-150">
                                    Mettre à jour
                                </button>
                            </div>
                        </form>
                    </div>
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
                                <dt class="text-sm font-medium text-gray-500">Type de sinistre</dt>
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
                                    {{ $typesSinistres[$sinistre->type_sinistre] ?? ucfirst(str_replace('_', ' ', $sinistre->type_sinistre)) }}
                                </dd>
                            </div>
                            <div class="sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-500">Date du sinistre</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $sinistre->date_sinistre->format('d/m/Y') }}</dd>
                            </div>
                            <div class="sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-500">Heure du sinistre</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $sinistre->heure_sinistre }}</dd>
                            </div>
                            <div class="sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-500">Lieu du sinistre</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $sinistre->lieu_sinistre }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>

            <!-- Calcul d'indemnisation -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Détails du calcul d'indemnisation</h3>
                    
                    <!-- Payment Summary -->
                    <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                        <h4 class="text-sm font-medium text-gray-700 mb-2">Résumé des paiements</h4>
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div>
                                <span class="text-gray-600">Total des paiements validés:</span>
                                <span class="font-medium">{{ number_format($sinistre->payments->where('status', 'completed')->sum('amount'), 2) }} MAD</span>
                            </div>
                            <div>
                                <span class="text-gray-600">Paiements en attente:</span>
                                <span class="font-medium">{{ number_format($sinistre->payments->where('status', 'pending')->sum('amount'), 2) }} MAD</span>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('admin.sinistres.update', $sinistre) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PATCH')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="montant_sinistre" class="block text-sm font-medium text-gray-700">Montant total du sinistre</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input type="number" step="0.01" name="montant_sinistre" id="montant_sinistre" 
                                           value="{{ $sinistre->montant_sinistre }}"
                                           class="block w-full pr-12 sm:text-sm border-gray-300 rounded-md focus:ring-[#00008f] focus:border-[#00008f]" 
                                           placeholder="0.00"
                                           onchange="calculateIndemnisation()">
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">MAD</span>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label for="franchise" class="block text-sm font-medium text-gray-700">Franchise</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input type="number" step="0.01" name="franchise" id="franchise" 
                                           value="{{ $sinistre->franchise }}"
                                           class="block w-full pr-12 sm:text-sm border-gray-300 rounded-md focus:ring-[#00008f] focus:border-[#00008f]" 
                                           placeholder="0.00"
                                           onchange="calculateIndemnisation()">
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">MAD</span>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label for="taux_couverture" class="block text-sm font-medium text-gray-700">Taux de couverture (%)</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input type="number" step="1" min="0" max="100" name="taux_couverture" id="taux_couverture" 
                                           value="{{ $sinistre->taux_couverture }}"
                                           class="block w-full pr-12 sm:text-sm border-gray-300 rounded-md focus:ring-[#00008f] focus:border-[#00008f]" 
                                           placeholder="100"
                                           onchange="calculateIndemnisation()">
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">%</span>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label for="indemnisation" class="block text-sm font-medium text-gray-700">Montant de l'indemnisation</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input type="number" step="0.01" name="indemnisation" id="indemnisation" 
                                           value="{{ $sinistre->indemnisation }}"
                                           class="block w-full pr-12 sm:text-sm border-gray-300 rounded-md focus:ring-[#00008f] focus:border-[#00008f] bg-gray-50" 
                                           placeholder="0.00"
                                           readonly>
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">MAD</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-[#00008f] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#000066] focus:bg-[#000066] active:bg-[#000066] focus:outline-none focus:ring-2 focus:ring-[#00008f] focus:ring-offset-2 transition ease-in-out duration-150">
                                Mettre à jour le calcul
                            </button>
                        </div>
                    </form>

                    <script>
                        function calculateIndemnisation() {
                            const montantSinistre = parseFloat(document.getElementById('montant_sinistre').value) || 0;
                            const franchise = parseFloat(document.getElementById('franchise').value) || 0;
                            const tauxCouverture = parseFloat(document.getElementById('taux_couverture').value) || 0;
                            
                            // Calculate indemnisation: (montant_sinistre - franchise) * (taux_couverture / 100)
                            const indemnisation = (montantSinistre - franchise) * (tauxCouverture / 100);
                            
                            // Round to 2 decimal places and ensure non-negative value
                            const finalIndemnisation = Math.max(0, Math.round(indemnisation * 100) / 100);
                            
                            document.getElementById('indemnisation').value = finalIndemnisation;
                        }

                        // Calculate initial value
                        document.addEventListener('DOMContentLoaded', calculateIndemnisation);
                    </script>
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
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Documents</h3>
                    @if($sinistre->documents->isEmpty())
                        <div class="text-center py-4">
                            <!-- Empty state with modern icon -->
                            <svg class="mx-auto h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m6.75 12H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                            <p class="mt-2 text-sm text-gray-500">Aucun document n'a été téléchargé pour ce sinistre.</p>
                        </div>
                    @else
                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                            @foreach($sinistre->documents as $document)
                                <div class="relative group border rounded-lg p-3 hover:shadow-md transition-shadow duration-200 flex flex-col justify-between h-24">
                                    <div class="flex items-start space-x-2">
                                        <!-- Document type icon based on mime type -->
                                        <div class="flex-shrink-0">
                                            @if(str_contains($document->type_mime, 'image'))
                                                <svg class="h-6 w-6 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                                </svg>
                                            @elseif(str_contains($document->type_mime, 'pdf'))
                                                <svg class="h-6 w-6 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                                </svg>
                                            @else
                                                <svg class="h-6 w-6 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                                </svg>
                                            @endif
                                        </div>

                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900 truncate" title="{{ $document->nom }}">
                                                {{ $document->nom }}
                                            </p>
                                            <p class="text-[11px] text-gray-500">
                                                {{ $document->created_at->format('d/m/Y H:i') }}
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Action buttons with modern icons -->
                                    <div class="flex justify-end space-x-1">
                                        <a href="{{ route('admin.documents.show', $document) }}" 
                                           class="p-1.5 rounded-full text-gray-600 hover:text-[#00008f] hover:bg-gray-100 transition-all duration-150"
                                           target="_blank"
                                           title="Voir le document">
                                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </a>
                                        <a href="{{ route('admin.documents.download', $document) }}" 
                                           class="p-1.5 rounded-full text-gray-600 hover:text-[#00008f] hover:bg-gray-100 transition-all duration-150"
                                           title="Télécharger le document">
                                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <!-- Historique des paiements -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Historique des paiements</h3>
                    @if($sinistre->payments->isEmpty())
                        <div class="text-center py-4">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <p class="mt-2 text-sm text-gray-500">Aucun paiement n'a été effectué pour ce sinistre.</p>
                        </div>
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
                                                        @else bg-red-100 text-red-800
                                                        @endif">
                                                        {{ ucfirst($payment->status) }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {{ ucfirst($payment->payment_method) }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    @if($payment->status === 'pending')
                                                        <form action="{{ route('admin.payments.update', $payment) }}" method="POST" class="inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="status" value="completed">
                                                            <button type="submit" class="text-green-600 hover:text-green-900">Valider</button>
                                                        </form>
                                                        <span class="text-gray-300 mx-2">|</span>
                                                        <form action="{{ route('admin.payments.update', $payment) }}" method="POST" class="inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="status" value="cancelled">
                                                            <button type="submit" class="text-red-600 hover:text-red-900">Refuser</button>
                                                        </form>
                                                    @else
                                                        -
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
        </div>
    </div>
</x-app-layout> 