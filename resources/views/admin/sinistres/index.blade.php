@extends('admin.layouts.app')

@section('title', 'Gestion des Sinistres')

@section('content')
    <div class="mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">{{ __('Gestion des Sinistres') }}</h2>
    </div>

    <!-- Search Bar -->
    <div class="mb-6">
        <form action="{{ route('admin.sinistres.index') }}" method="GET" class="relative">
            <input
                type="text"
                name="search"
                id="searchInput"
                value="{{ request('search') }}"
                placeholder="Rechercher par numéro, client, véhicule..."
                class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-200 focus:border-[#00008f] focus:ring focus:ring-[#00008f] focus:ring-opacity-20 transition-all duration-200"
                autocomplete="off"
            >
            <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            @if(request()->filled('search'))
                <a href="{{ route('admin.sinistres.index') }}" 
                   class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </a>
            @endif
        </form>
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

@push('scripts')
<script>
    const searchInput = document.getElementById('searchInput');
    let timeoutId;

    searchInput.addEventListener('input', function() {
        clearTimeout(timeoutId);
        timeoutId = setTimeout(() => {
            this.closest('form').submit();
        }, 300);
    });
</script>
@endpush 