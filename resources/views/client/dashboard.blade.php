<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Client Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">{{ __("Welcome to the Client Dashboard") }}</h3>
                    <p>You are logged in as a <strong>Client</strong>.</p>
                    <div class="mt-6">
                        <h4 class="text-md font-medium mb-2">{{ __("Client Actions:") }}</h4>
                        <ul class="list-disc pl-5">
                            <li>View your profile</li>
                            <li>Manage your account</li>
                            <li>Access client-specific features</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
