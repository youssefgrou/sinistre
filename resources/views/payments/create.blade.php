<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Formulaire de Paiement') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('client.payment.store', $sinistre) }}" method="POST" class="space-y-6" x-data="{ paymentMethod: 'cheque' }">
                        @csrf
                        
                        <!-- Payment Method Selection -->
                        <div class="space-y-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Mode de Paiement</label>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Cheque Option -->
                                <label class="relative flex items-center justify-between p-4 cursor-pointer bg-white border rounded-xl hover:border-indigo-500 transition-colors"
                                       :class="{ 'border-indigo-500 ring-2 ring-indigo-500 ring-opacity-20': paymentMethod === 'cheque' }">
                                    <div class="flex items-center">
                                        <input type="radio" name="payment_method" value="cheque" 
                                               class="hidden"
                                               x-model="paymentMethod">
                                        <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-indigo-50">
                                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <h3 class="font-medium text-gray-900">Chèque</h3>
                                            <p class="text-sm text-gray-500">Paiement par chèque bancaire</p>
                                        </div>
                                    </div>
                                    <div class="shrink-0 h-6 w-6 flex items-center justify-center rounded-full border"
                                         :class="{ 'border-indigo-600 bg-indigo-600': paymentMethod === 'cheque' }">
                                        <div class="h-3 w-3 rounded-full bg-white"
                                             x-show="paymentMethod === 'cheque'"></div>
                                    </div>
                                </label>

                                <!-- Virement Option -->
                                <label class="relative flex items-center justify-between p-4 cursor-pointer bg-white border rounded-xl hover:border-indigo-500 transition-colors"
                                       :class="{ 'border-indigo-500 ring-2 ring-indigo-500 ring-opacity-20': paymentMethod === 'virement' }">
                                    <div class="flex items-center">
                                        <input type="radio" name="payment_method" value="virement" 
                                               class="hidden"
                                               x-model="paymentMethod">
                                        <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-indigo-50">
                                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <h3 class="font-medium text-gray-900">Virement</h3>
                                            <p class="text-sm text-gray-500">Virement bancaire direct</p>
                                        </div>
                                    </div>
                                    <div class="shrink-0 h-6 w-6 flex items-center justify-center rounded-full border"
                                         :class="{ 'border-indigo-600 bg-indigo-600': paymentMethod === 'virement' }">
                                        <div class="h-3 w-3 rounded-full bg-white"
                                             x-show="paymentMethod === 'virement'"></div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Nom Complet</label>
                            <input type="text" name="name" id="name" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                value="{{ old('name') }}">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Address -->
                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700">Adresse</label>
                            <input type="text" name="address" id="address" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                value="{{ old('address') }}">
                            @error('address')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700">Téléphone</label>
                            <input type="tel" name="phone" id="phone" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                value="{{ old('phone') }}">
                            @error('phone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Amount -->
                        <div>
                            <label for="amount" class="block text-sm font-medium text-gray-700">Montant (MAD)</label>
                            <input type="number" name="amount" id="amount" step="0.01" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                value="{{ old('amount', $sinistre->amount ?? '') }}">
                            @error('amount')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Cheque Specific Fields -->
                        <div x-show="paymentMethod === 'cheque'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0">
                            <div class="space-y-4">
                                <div>
                                    <label for="cheque_number" class="block text-sm font-medium text-gray-700">Numéro du Chèque</label>
                                    <input type="text" name="cheque_number" id="cheque_number"
                                        x-bind:required="paymentMethod === 'cheque'"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                        value="{{ old('cheque_number') }}">
                                </div>
                                <div>
                                    <label for="bank_name" class="block text-sm font-medium text-gray-700">Nom de la Banque</label>
                                    <input type="text" name="bank_name" id="bank_name"
                                        x-bind:required="paymentMethod === 'cheque'"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                        value="{{ old('bank_name') }}">
                                </div>
                            </div>
                        </div>

                        <!-- Virement Specific Fields -->
                        <div x-show="paymentMethod === 'virement'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0">
                            <div class="space-y-4">
                                <div>
                                    <label for="transaction_id" class="block text-sm font-medium text-gray-700">Référence du Virement</label>
                                    <input type="text" name="transaction_id" id="transaction_id"
                                        x-bind:required="paymentMethod === 'virement'"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                        value="{{ old('transaction_id') }}">
                                </div>
                                <div>
                                    <label for="bank_name_virement" class="block text-sm font-medium text-gray-700">Banque Émettrice</label>
                                    <input type="text" name="bank_name_virement" id="bank_name_virement"
                                        x-bind:required="paymentMethod === 'virement'"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                        value="{{ old('bank_name_virement') }}">
                                </div>
                            </div>
                        </div>

                        <button type="submit"
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Soumettre le paiement
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 