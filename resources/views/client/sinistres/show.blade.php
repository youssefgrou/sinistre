<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Détails du sinistre') }} - {{ $sinistre->numero_sinistre }}
            </h2>
            <a href="{{ route('client.sinistres.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                {{ __('Retour à la liste') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Statut du sinistre -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Statut actuel</h3>
                            <span class="px-4 py-2 inline-flex text-sm leading-5 font-semibold rounded-full 
                                @if($sinistre->status === 'en_attente') bg-yellow-100 text-yellow-800
                                @elseif($sinistre->status === 'en_cours') bg-blue-100 text-blue-800
                                @elseif($sinistre->status === 'expertise') bg-purple-100 text-purple-800
                                @elseif($sinistre->status === 'validé') bg-green-100 text-green-800
                                @elseif($sinistre->status === 'refusé') bg-red-100 text-red-800
                                @endif">
                                {{ ucfirst(str_replace('_', ' ', $sinistre->status)) }}
                            </span>
                            
                            @if($sinistre->status === 'validé')
                                <a href="{{ route('client.payment.create', $sinistre) }}" 
                                   class="ml-4 inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                    </svg>
                                    Effectuer le paiement
                                </a>
                            @endif
                        </div>
                        <div class="text-sm text-gray-500">
                            Déclaré le {{ $sinistre->created_at->format('d/m/Y à H:i') }}
                        </div>
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
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-medium text-gray-900">Documents justificatifs</h3>
                        <button type="button" onclick="document.getElementById('document-upload').click()" class="inline-flex items-center px-4 py-2 bg-[#00008f] text-white text-sm font-medium rounded-md hover:bg-[#000066]">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Ajouter des documents
                        </button>
                    </div>

                    <form action="{{ route('client.sinistres.documents.upload', $sinistre) }}" method="POST" enctype="multipart/form-data" class="hidden">
                        @csrf
                        <input type="file" id="document-upload" name="documents[]" multiple onchange="this.form.submit()" class="hidden">
                    </form>

                    @if($sinistre->documents->isEmpty())
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Aucun document</h3>
                            <p class="mt-1 text-sm text-gray-500">Commencez par ajouter des documents justificatifs.</p>
                        </div>
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                            @foreach($sinistre->documents as $document)
                                <div class="relative group">
                                    <div class="block p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-all duration-200">
                                        <div class="flex items-center space-x-3">
                                            @if(in_array($document->type_document, ['jpg', 'jpeg', 'png']))
                                                <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                            @else
                                                <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                                </svg>
                                            @endif
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-medium text-gray-900 truncate" title="{{ $document->nom }}">
                                                    {{ Str::limit($document->nom, 20) }}
                                                </p>
                                                <p class="text-xs text-gray-500">{{ number_format($document->taille_fichier / 1024, 2) }} KB</p>
                                            </div>
                                        </div>
                                        <div class="mt-4 flex justify-end space-x-2">
                                            <a href="{{ Storage::url($document->chemin_fichier) }}" target="_blank" class="inline-flex items-center p-1.5 text-gray-700 hover:text-[#00008f] transition-colors duration-200" title="Voir">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                            </a>
                                            
                                        </div>
                                    </div>
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
                        
                        @if($sinistre->indemnisation === null)
                            <button disabled class="inline-flex items-center px-4 py-2 bg-gray-300 text-gray-600 rounded-md font-semibold text-xs uppercase tracking-widest cursor-not-allowed">
                                Paiement indisponible
                            </button>
                            <p class="text-sm text-gray-500 mt-2">Le paiement sera disponible après le calcul de l'indemnisation par l'administrateur.</p>
                        @else
                            <a href="{{ route('client.payment.create', $sinistre) }}" class="inline-flex items-center px-4 py-2 bg-[#00008f] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#000066] focus:bg-[#000066] active:bg-[#000066] focus:outline-none focus:ring-2 focus:ring-[#00008f] focus:ring-offset-2 transition ease-in-out duration-150">
                                Effectuer un paiement
                            </a>
                        @endif
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
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Montant</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Méthode</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($sinistre->payments as $payment)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {{ $payment->created_at->format('d/m/Y H:i') }}
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
            <!-- Commentaire administrateur -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Commentaire de l'administrateur</h3>
                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-yellow-700">
                                    {{ $sinistre->commentaire_admin }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout> 