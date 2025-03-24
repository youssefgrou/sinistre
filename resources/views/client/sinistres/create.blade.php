<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Formulaire de déclaration de sinistre - Saisie par l'agent") }}
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
                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 transition-all duration-200 ease-in-out"
                                     id="dropzone"
                                     x-data="{ dragOver: false }"
                                     x-on:dragover.prevent="dragOver = true"
                                     x-on:dragleave.prevent="dragOver = false"
                                     x-on:drop.prevent="dragOver = false"
                                     :class="{ 'border-blue-500 bg-blue-50': dragOver }">
                                    
                                    <div class="text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <div class="mt-4 flex flex-col items-center text-sm text-gray-600">
                                            <label for="documents" class="relative cursor-pointer rounded-md bg-white font-medium text-blue-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-blue-500 focus-within:ring-offset-2 hover:text-blue-500">
                                                <span>Télécharger des fichiers</span>
                                                <input id="documents" name="documents[]" type="file" class="sr-only" multiple accept=".jpg,.jpeg,.png,.pdf,.doc,.docx">
                                            </label>
                                            <p class="pl-1 mt-2">ou glisser-déposer vos fichiers ici</p>
                                        </div>
                                        <p class="text-xs text-gray-500 mt-2">PNG, JPG, PDF jusqu'à 10MB</p>
                                    </div>
                                </div>

                                <!-- Preview Grid -->
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
        const dropzone = document.getElementById('dropzone');
        const input = document.querySelector('input[type="file"]');
        const preview = document.querySelector('#preview');

        // Handle drag and drop
        dropzone.addEventListener('drop', function(e) {
            e.preventDefault();
            const files = e.dataTransfer.files;
            handleFiles(files);
        });

        // Handle file input change
        input.addEventListener('change', function() {
            handleFiles(this.files);
        });

        function handleFiles(files) {
            preview.innerHTML = ''; // Clear existing previews
            Array.from(files).forEach(file => {
                const reader = new FileReader();
                const div = document.createElement('div');
                div.className = 'relative group';

                reader.onload = function(e) {
                    if (file.type.startsWith('image/')) {
                        div.innerHTML = `
                            <div class="relative aspect-w-3 aspect-h-2 rounded-lg overflow-hidden shadow-lg group-hover:opacity-75 transition-opacity">
                                <img src="${e.target.result}" class="w-full h-32 object-cover rounded-lg">
                                <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                    <span class="text-white text-sm px-2 py-1">${file.name}</span>
                                </div>
                            </div>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500 truncate">${file.name}</p>
                                <p class="text-xs text-gray-400">${formatFileSize(file.size)}</p>
                            </div>
                        `;
                    } else {
                        const icon = getFileIcon(file.type);
                        div.innerHTML = `
                            <div class="relative aspect-w-3 aspect-h-2 rounded-lg overflow-hidden bg-gray-100 shadow-lg group-hover:bg-gray-200 transition-colors">
                                <div class="absolute inset-0 flex items-center justify-center">
                                    ${icon}
                                </div>
                                <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                    <span class="text-white text-sm px-2 py-1">${file.name}</span>
                                </div>
                            </div>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500 truncate">${file.name}</p>
                                <p class="text-xs text-gray-400">${formatFileSize(file.size)}</p>
                            </div>
                        `;
                    }
                };
                reader.readAsDataURL(file);
                preview.appendChild(div);
            });
        }

        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        function getFileIcon(type) {
            if (type.includes('pdf')) {
                return `<svg class="w-12 h-12 text-red-500" fill="currentColor" viewBox="0 0 384 512">
                    <path d="M181.9 256.1c-5-16-4.9-46.9-2-46.9 8.4 0 7.6 36.9 2 46.9zm-1.7 47.2c-7.7 20.2-17.3 43.3-28.4 62.7 18.3-7 39-17.2 62.9-21.9-12.7-9.6-24.9-23.4-34.5-40.8zM86.1 428.1c0 .8 13.2-5.4 34.9-40.2-6.7 6.3-29.1 24.5-34.9 40.2zM248 160h136v328c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V24C0 10.7 10.7 0 24 0h200v136c0 13.2 10.8 24 24 24zm-8 171.8c-20-12.2-33.3-29-42.7-53.8 4.5-18.5 11.6-46.6 6.2-64.2-4.7-29.4-42.4-26.5-47.8-6.8-5 18.3-.4 44.1 8.1 77-11.6 27.6-28.7 64.6-40.8 85.8-.1 0-.1.1-.2.1-27.1 13.9-73.6 44.5-54.5 68 5.6 6.9 16 10 21.5 10 17.9 0 35.7-18 61.1-61.8 25.8-8.5 54.1-19.1 79-23.2 21.7 11.8 47.1 19.5 64 19.5 29.2 0 31.2-32 19.7-43.4-13.9-13.6-54.3-9.7-73.6-7.2zM377 105L279 7c-4.5-4.5-10.6-7-17-7h-6v128h128v-6.1c0-6.3-2.5-12.4-7-16.9zm-74.1 255.3c4.1-2.7-2.5-11.9-42.8-9 37.1 15.8 42.8 9 42.8 9z"/>
                </svg>`;
            }
            if (type.includes('word') || type.includes('doc')) {
                return `<svg class="w-12 h-12 text-blue-500" fill="currentColor" viewBox="0 0 384 512">
                    <path d="M224 136V0H24C10.7 0 0 10.7 0 24v464c0 13.3 10.7 24 24 24h336c13.3 0 24-10.7 24-24V160H248c-13.2 0-24-10.8-24-24zm57.1 120H208c-6.6 0-12-5.4-12-12v-8c0-6.6 5.4-12 12-12h73.1c6.6 0 12 5.4 12 12v8c0 6.6-5.4 12-12 12zm0 64H208c-6.6 0-12-5.4-12-12v-8c0-6.6 5.4-12 12-12h73.1c6.6 0 12 5.4 12 12v8c0 6.6-5.4 12-12 12z"/>
                </svg>`;
            }
            return `<svg class="w-12 h-12 text-gray-400" fill="currentColor" viewBox="0 0 384 512">
                <path d="M224 136V0H24C10.7 0 0 10.7 0 24v464c0 13.3 10.7 24 24 24h336c13.3 0 24-10.7 24-24V160H248c-13.2 0-24-10.8-24-24zm160-14.1v6.1H256V0h6.1c6.4 0 12.5 2.5 17 7l97.9 98c4.5 4.5 7 10.6 7 16.9z"/>
            </svg>`;
        }
    </script>
    @endpush
</x-app-layout>
