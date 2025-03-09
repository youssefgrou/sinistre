<x-guest-layout>
    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-gray-900">Create Account</h2>
        <p class="text-gray-600 mt-1">Join us today!</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div class="space-y-2">
            <x-input-label for="name" :value="__('Name')" class="text-sm font-medium" />
            <x-text-input id="name" 
                class="block w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-blue-500" 
                type="text" 
                name="name" 
                :value="old('name')" 
                required 
                autofocus 
                autocomplete="name"
                placeholder="Enter your full name" />
            <x-input-error :messages="$errors->get('name')" class="mt-1" />
        </div>

        <!-- Email Address -->
        <div class="space-y-2">
            <x-input-label for="email" :value="__('Email')" class="text-sm font-medium" />
            <x-text-input id="email" 
                class="block w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-blue-500" 
                type="email" 
                name="email" 
                :value="old('email')" 
                required 
                autocomplete="username"
                placeholder="Enter your email" />
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Password -->
        <div class="space-y-2">
            <x-input-label for="password" :value="__('Password')" class="text-sm font-medium" />
            <x-text-input id="password" 
                class="block w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                type="password"
                name="password"
                required 
                autocomplete="new-password"
                placeholder="Create a password" />
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <!-- Confirm Password -->
        <div class="space-y-2">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-sm font-medium" />
            <x-text-input id="password_confirmation" 
                class="block w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                type="password"
                name="password_confirmation" 
                required 
                autocomplete="new-password"
                placeholder="Confirm your password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
        </div>

        <div class="space-y-4">
            <x-primary-button class="w-full justify-center py-3 bg-[#00008f] hover:bg-[#000066]">
                {{ __('Register') }}
            </x-primary-button>

            <p class="text-center text-sm text-gray-600">
                Already have an account?
                <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 hover:underline">Sign in</a>
            </p>
        </div>
    </form>
</x-guest-layout>
