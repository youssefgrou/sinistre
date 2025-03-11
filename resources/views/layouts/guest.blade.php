<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .background-pattern {
                background-color: #f8fafc;
                background-image: 
                    radial-gradient(at 47% 33%, rgb(196, 181, 253, 0.5) 0, transparent 59%), 
                    radial-gradient(at 82% 65%, rgb(129, 140, 248, 0.4) 0, transparent 55%),
                    radial-gradient(at 20% 80%, rgb(167, 139, 250, 0.3) 0, transparent 50%);
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: -1;
            }

            .card-glass {
                background: rgba(255, 255, 255, 0.7);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.2);
                box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.07);
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="background-pattern"></div>
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div class="w-32 h-32 flex items-center justify-center p-2">
                <a href="/">
                    <x-application-logo class="w-full h-full" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 card-glass overflow-hidden sm:rounded-2xl">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
