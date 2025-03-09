<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Déclarer un sinistre') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('client.sinistres.store') }}" class="space-y-6" enctype="multipart/form-data">
                        @csrf

                        <!-- Informations du véhicule -->
                        <div class="border-b border-gray-200 pb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Informations du véhicule</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <x-input-label for="immatriculation" :value="__('Immatriculation')" />
                                    <x-text-input id="immatriculation" class="block mt-1 w-full" type="text" name="immatriculation" :value="old('immatriculation')" required />
                                    <x-input-error :messages="$errors->get('immatriculation')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="marque" :value="__('Marque')" />
                                    <x-text-input id="marque" class="block mt-1 w-full" type="text" name="marque" :value="old('marque')" required />
                                    <x-input-error :messages="$errors->get('marque')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="modele" :value="__('Modèle')" />
                                    <x-text-input id="modele" class="block mt-1 w-full" type="text" name="modele" :value="old('modele')" required />
                                    <x-input-error :messages="$errors->get('modele')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <!-- Informations du sinistre -->
                        <div class="border-b border-gray-200 pb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Informations du sinistre</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <x-input-label for="date_sinistre" :value="__('Date du sinistre')" />
                                    <x-text-input id="date_sinistre" class="block mt-1 w-full" type="date" name="date_sinistre" :value="old('date_sinistre')" required />
                                    <x-input-error :messages="$errors->get('date_sinistre')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="heure_sinistre" :value="__('Heure du sinistre')" />
                                    <x-text-input id="heure_sinistre" class="block mt-1 w-full" type="time" name="heure_sinistre" :value="old('heure_sinistre')" required />
                                    <x-input-error :messages="$errors->get('heure_sinistre')" class="mt-2" />
                                </div>

                                <div class="md:col-span-2">
                                    <x-input-label for="lieu_sinistre" :value="__('Lieu du sinistre')" />
                                    <x-text-input id="lieu_sinistre" class="block mt-1 w-full" type="text" name="lieu_sinistre" :value="old('lieu_sinistre')" required placeholder="Adresse complète du lieu du sinistre" />
                                    <x-input-error :messages="$errors->get('lieu_sinistre')" class="mt-2" />
                                </div>

                                <div class="md:col-span-2">
                                    <x-input-label for="type_sinistre" :value="__('Type de sinistre')" />
                                    <select id="type_sinistre" name="type_sinistre" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                        <option value="">Sélectionnez le type de sinistre</option>
                                        <option value="vol_tentative_vol">Vol et tentative de vol</option>
                                        <option value="vandalisme_degradations">Vandalisme et dégradations volontaires</option>
                                        <option value="incendie_explosion">Incendie et explosion</option>
                                        <option value="bris_glaces">Bris de glaces</option>
                                        <option value="collision_route">Collission de la Route</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('type_sinistre')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <!-- Description et circonstances -->
                        <div class="border-b border-gray-200 pb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Description et circonstances</h3>
                            <div class="space-y-6">
                                <div>
                                    <x-input-label for="description" :value="__('Description des dommages')" />
                                    <textarea id="description" name="description" rows="3" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>{{ old('description') }}</textarea>
                                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="circonstances" :value="__('Circonstances détaillées')" />
                                    <textarea id="circonstances" name="circonstances" rows="4" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>{{ old('circonstances') }}</textarea>
                                    <x-input-error :messages="$errors->get('circonstances')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <!-- Documents justificatifs -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Documents justificatifs</h3>
                            <div class="space-y-4">
                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6">
                                    <div class="text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <div class="mt-4 flex text-sm text-gray-600">
                                            <label for="documents" class="relative cursor-pointer rounded-md bg-white font-medium text-blue-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-blue-500 focus-within:ring-offset-2 hover:text-blue-500">
                                                <span>Télécharger des fichiers</span>
                                                <input id="documents" name="documents[]" type="file" class="sr-only" multiple accept=".jpg,.jpeg,.png,.pdf,.doc,.docx">
                                            </label>
                                            <p class="pl-1">ou glisser-déposer</p>
                                        </div>
                                        <p class="text-xs text-gray-500">PNG, JPG, PDF jusqu'à 10MB</p>
                                    </div>
                                </div>
                                <div id="preview" class="grid grid-cols-2 md:grid-cols-4 gap-4"></div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button class="ml-4">
                                {{ __('Soumettre la déclaration') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        const input = document.querySelector('input[type="file"]');
        const preview = document.querySelector('#preview');

        input.addEventListener('change', function() {
            preview.innerHTML = '';
            Array.from(this.files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'relative';
                    if (file.type.startsWith('image/')) {
                        div.innerHTML = `
                            <img src="${e.target.result}" class="w-full h-32 object-cover rounded-lg">
                            <span class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-50 text-white text-xs p-1 truncate">
                                ${file.name}
                            </span>
                        `;
                    } else {
                        div.innerHTML = `
                            <div class="w-full h-32 flex items-center justify-center bg-gray-100 rounded-lg">
                                <span class="text-sm text-gray-600">${file.name}</span>
                            </div>
                        `;
                    }
                    preview.appendChild(div);
                };
                reader.readAsDataURL(file);
            });
        });
    </script>
    @endpush
</x-app-layout> 