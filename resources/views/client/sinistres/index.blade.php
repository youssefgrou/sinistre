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
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if($sinistres->isEmpty())
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Aucun sinistre</h3>
                            <p class="mt-1 text-sm text-gray-500">Commencez par déclarer un sinistre.</p>
                            <div class="mt-6">
                                <a href="{{ route('client.sinistres.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-[#00008f] hover:bg-[#000066] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#00008f]">
                                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                                    </svg>
                                    Déclarer un sinistre
                                </a>
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
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                    @if($sinistre->status === 'en_attente') bg-yellow-100 text-yellow-800
                                                    @elseif($sinistre->status === 'en_cours') bg-blue-100 text-blue-800
                                                    @elseif($sinistre->status === 'expertise') bg-purple-100 text-purple-800
                                                    @elseif($sinistre->status === 'validé') bg-green-100 text-green-800
                                                    @elseif($sinistre->status === 'refusé') bg-red-100 text-red-800
                                                    @endif">
                                                    {{ ucfirst(str_replace('_', ' ', $sinistre->status)) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                <a href="{{ route('client.sinistres.show', $sinistre) }}" class="text-blue-600 hover:text-blue-900">Détails</a>
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