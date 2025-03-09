<x-guest-layout>
    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-gray-900">Welcome Back!</h2>
        <p class="text-gray-600 mt-1">Please sign in to your account</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div class="space-y-2">
            <x-input-label for="email" :value="__('Email')" class="text-sm font-medium" />
            <x-text-input id="email" 
                class="block w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-blue-500" 
                type="email" 
                name="email" 
                :value="old('email')" 
                required 
                autofocus 
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
                autocomplete="current-password"
                placeholder="Enter your password" />
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-blue-600 hover:text-blue-800 hover:underline" href="{{ route('password.request') }}">
                    {{ __('Forgot password?') }}
                </a>
            @endif
        </div>

        <div class="space-y-4">
            <x-primary-button class="w-full justify-center py-3 bg-[#00008f] hover:bg-[#000066]">
                {{ __('Sign in') }}
            </x-primary-button>

            <p class="text-center text-sm text-gray-600">
                Don't have an account?
                <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800 hover:underline">Create an account</a>
            </p>
        </div>
    </form>
</x-guest-layout>
