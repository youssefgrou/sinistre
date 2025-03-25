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
                    <!-- Payment Summary -->
                    <div class="mb-6 bg-gradient-to-br from-gray-50 to-white rounded-xl shadow-sm border border-gray-100">
                        <div class="flex items-center justify-between border-b border-gray-100 p-4">
                            <h3 class="text-base font-semibold text-gray-900">Résumé du paiement</h3>
                            @if($remainingAmount <= 0)
                                <div class="flex items-center bg-green-50 px-2.5 py-1 rounded-full">
                                    <svg class="w-4 h-4 text-green-600 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-xs font-medium text-green-600">Franchise payée</span>
                                </div>
                            @endif
                        </div>
                        
                        <div class="p-4 space-y-4">
                            <div class="grid grid-cols-2 gap-4">
                                <div class="col-span-2 md:col-span-1">
                                    <div class="flex justify-between items-baseline">
                                        <span class="text-xs font-medium text-gray-500">Montant total:</span>
                                        <span class="text-sm font-semibold text-gray-900">{{ number_format($sinistre->montant_sinistre, 2) }} <span class="text-xs font-normal text-gray-500">MAD</span></span>
                                    </div>
                                    <div class="flex justify-between items-baseline mt-2">
                                        <span class="text-xs font-medium text-gray-500">Taux de couverture:</span>
                                        <span class="text-sm font-semibold text-gray-900">{{ number_format($sinistre->taux_couverture, 2) }} <span class="text-xs font-normal text-gray-500">%</span></span>
                                    </div>
                                </div>

                                <div class="col-span-2 md:col-span-1">
                                    <div class="flex justify-between items-baseline">
                                        <span class="text-xs font-medium text-[#00008f]/70">Franchise:</span>
                                        <span class="text-sm font-semibold text-[#00008f]">{{ number_format($sinistre->franchise, 2) }} <span class="text-xs font-normal text-[#00008f]/70">MAD</span></span>
                                    </div>
                                    <div class="flex justify-between items-baseline mt-2">
                                        <span class="text-xs font-medium text-green-600/70">Indemnisation:</span>
                                        <span class="text-sm font-semibold text-green-600">{{ number_format($sinistre->indemnisation, 2) }} <span class="text-xs font-normal text-green-600/70">MAD</span></span>
                                    </div>
                                </div>
                            </div>

                            <div class="border-t border-gray-100 pt-4">
                                <div class="flex justify-between items-baseline">
                                    <span class="text-xs font-medium text-gray-500">Montant à payer:</span>
                                    <span class="text-base font-bold {{ $remainingAmount <= 0 ? 'text-green-600' : 'text-[#00008f]' }}">
                                        {{ number_format($remainingAmount, 2) }} <span class="text-xs font-normal {{ $remainingAmount <= 0 ? 'text-green-600/70' : 'text-[#00008f]/70' }}">MAD</span>
                                    </span>
                                </div>
                            </div>

                            <div class="bg-blue-50/50 rounded-lg p-3 flex items-start space-x-2">
                                <svg class="w-4 h-4 text-blue-600 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                </svg>
                                <p class="text-xs text-blue-800">
                                    <span class="font-semibold">Note:</span> Seule la franchise de {{ number_format($sinistre->franchise, 2) }} MAD est à payer. L'indemnisation sera versée par l'assurance.
                                </p>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('client.payment.store', $sinistre) }}" method="POST" class="space-y-6" x-data="{ paymentMethod: 'cheque' }">
                        @csrf
                        
                        <!-- Payment Method Selection -->
                        <div class="space-y-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Mode de Paiement</label>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <!-- Cheque Option -->
                                <label class="relative flex cursor-pointer rounded-lg border bg-white p-4 shadow-sm focus:outline-none hover:border-[#00008f] transition-colors"
                                       :class="{ 'border-[#00008f] ring-2 ring-[#00008f] ring-opacity-20': paymentMethod === 'cheque' }">
                                    <input type="radio" name="payment_method" value="cheque" class="sr-only" x-model="paymentMethod" checked>
                                    <div class="flex items-center w-full">
                                        <div class="flex-shrink-0 bg-[#e0e7ff] rounded-lg p-2">
                                            <svg class="w-6 h-6 text-[#00008f]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                        </div>
                                        <div class="ml-4 flex flex-col">
                                            <span class="block text-sm font-medium text-gray-900">Chèque</span>
                                            <span class="block text-xs text-gray-500">Paiement par chèque bancaire</span>
                                        </div>
                                        <div class="ml-auto h-5 w-5 flex items-center" x-show="paymentMethod === 'cheque'">
                                            <svg class="w-5 h-5 text-[#00008f]" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>
                                </label>

                                <!-- Virement Option -->
                                <label class="relative flex cursor-pointer rounded-lg border bg-white p-4 shadow-sm focus:outline-none hover:border-[#00008f] transition-colors"
                                       :class="{ 'border-[#00008f] ring-2 ring-[#00008f] ring-opacity-20': paymentMethod === 'virement' }">
                                    <input type="radio" name="payment_method" value="virement" class="sr-only" x-model="paymentMethod">
                                    <div class="flex items-center w-full">
                                        <div class="flex-shrink-0 bg-[#e0e7ff] rounded-lg p-2">
                                            <svg class="w-6 h-6 text-[#00008f]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
                                            </svg>
                                        </div>
                                        <div class="ml-4 flex flex-col">
                                            <span class="block text-sm font-medium text-gray-900">Virement</span>
                                            <span class="block text-xs text-gray-500">Virement bancaire direct</span>
                                        </div>
                                        <div class="ml-auto h-5 w-5 flex items-center" x-show="paymentMethod === 'virement'">
                                            <svg class="w-5 h-5 text-[#00008f]" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>
                                </label>

                                <!-- Especes Option -->
                                <label class="relative flex cursor-pointer rounded-lg border bg-white p-4 shadow-sm focus:outline-none hover:border-[#00008f] transition-colors"
                                       :class="{ 'border-[#00008f] ring-2 ring-[#00008f] ring-opacity-20': paymentMethod === 'especes' }">
                                    <input type="radio" name="payment_method" value="especes" class="sr-only" x-model="paymentMethod">
                                    <div class="flex items-center w-full">
                                        <div class="flex-shrink-0 bg-[#e0e7ff] rounded-lg p-2">
                                            <svg class="w-6 h-6 text-[#00008f]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2" />
                                            </svg>
                                        </div>
                                        <div class="ml-4 flex flex-col">
                                            <span class="block text-sm font-medium text-gray-900">Espèces</span>
                                            <span class="block text-xs text-gray-500">Paiement en espèces</span>
                                        </div>
                                        <div class="ml-auto h-5 w-5 flex items-center" x-show="paymentMethod === 'especes'">
                                            <svg class="w-5 h-5 text-[#00008f]" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Payment Details -->
                        <div class="space-y-6">
                        <!-- Name -->
                        <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Nom complet</label>
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
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input type="number" name="amount" id="amount" step="0.01" required readonly
                                        class="block w-full pr-12 rounded-md border-gray-300 bg-gray-50 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm cursor-not-allowed"
                                        value="{{ old('amount', number_format($sinistre->franchise, 2, '.', '')) }}">
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">MAD</span>
                                    </div>
                                </div>
                                <p class="mt-1 text-sm text-gray-500">Le montant de la franchise est fixe et ne peut pas être modifié.</p>
                            @error('amount')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                            <!-- Cheque specific fields -->
                            <div x-show="paymentMethod === 'cheque'" class="space-y-6">
                                <div>
                                    <label for="cheque_number" class="block text-sm font-medium text-gray-700">Numéro du chèque</label>
                                    <input type="text" name="cheque_number" id="cheque_number"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                        value="{{ old('cheque_number') }}">
                                </div>
                                <div>
                                    <label for="bank_name" class="block text-sm font-medium text-gray-700">Nom de la banque</label>
                                    <input type="text" name="bank_name" id="bank_name"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                        value="{{ old('bank_name') }}">
                            </div>
                        </div>

                            <!-- Virement specific fields -->
                            <div x-show="paymentMethod === 'virement'" class="space-y-6">
                                <div>
                                    <label for="transaction_id" class="block text-sm font-medium text-gray-700">ID de transaction</label>
                                    <input type="text" name="transaction_id" id="transaction_id"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                        value="{{ old('transaction_id') }}">
                                </div>
                                <div>
                                    <label for="bank_name_virement" class="block text-sm font-medium text-gray-700">Nom de la banque</label>
                                    <input type="text" name="bank_name_virement" id="bank_name_virement"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                        value="{{ old('bank_name_virement') }}">
                            </div>
                        </div>

                            <!-- Especes specific field -->
                            <div x-show="paymentMethod === 'especes'" class="space-y-6">
                                <div>
                                    <label for="receipt_number" class="block text-sm font-medium text-gray-700">Numéro de reçu</label>
                                    <input type="text" name="receipt_number" id="receipt_number"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                        value="{{ old('receipt_number') }}">
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-[#00008f] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#000066] focus:bg-[#000066] active:bg-[#000066] focus:outline-none focus:ring-2 focus:ring-[#00008f] focus:ring-offset-2 transition ease-in-out duration-150">
                                Confirmer le paiement
                        </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 