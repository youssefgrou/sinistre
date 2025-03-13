@extends('admin.layouts.app')

@section('title', 'Gestion des Sinistres')

@section('content')
    <div class="mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">{{ __('Gestion des Sinistres') }}</h2>
    </div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">N° Sinistre</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Véhicule</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($sinistres as $sinistre)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $sinistre->numero_sinistre }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $sinistre->user->name }}<br>
                                    <span class="text-xs text-gray-400">{{ $sinistre->user->email }}</span>
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
                                    <a href="{{ route('admin.sinistres.show', $sinistre) }}" 
                                       class="text-indigo-600 hover:text-indigo-900">
                                        Voir détails
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $sinistres->links() }}
            </div>
        </div>
    </div>
@endsection 