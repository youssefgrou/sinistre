<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Sinistre Auto') }} - Gestion des sinistres automobiles</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
            @vite(['resources/css/app.css', 'resources/js/app.js'])
            <style>
        [x-cloak] { display: none !important; }
        .gradient-text {
            @apply bg-clip-text text-transparent bg-gradient-to-r from-[#00008F] to-[#0000CF];
        }
        .btn-primary {
            @apply bg-[#00008F] hover:bg-[#0000CF] text-white font-semibold py-3 px-6 rounded-lg transition duration-300;
        }
        .btn-secondary {
            @apply border-2 border-[#00008F] text-[#00008F] hover:bg-[#00008F] hover:text-white font-semibold py-3 px-6 rounded-lg transition duration-300;
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        .float-animation {
            animation: float 3s ease-in-out infinite;
        }
        @keyframes slideInLeft {
            0% { transform: translateX(-100px); opacity: 0; }
            100% { transform: translateX(0); opacity: 1; }
        }
        @keyframes slideInRight {
            0% { transform: translateX(100px); opacity: 0; }
            100% { transform: translateX(0); opacity: 1; }
        }
        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }
        .animate-slide-left {
            animation: slideInLeft 0.8s ease-out forwards;
        }
        .animate-slide-right {
            animation: slideInRight 0.8s ease-out forwards;
        }
        .animate-fade-in {
            animation: fadeIn 1s ease-out forwards;
        }
        .process-line {
            @apply absolute top-6 left-1/2 h-0.5 bg-gradient-to-r from-[#00008F] to-[#FF1721] transform -translate-x-1/2;
            width: 0;
            transition: width 1s ease-out;
        }
        .process-line.active {
            width: 100%;
        }
            </style>
    </head>
<body class="antialiased bg-gray-50">
    <!-- Simple Navigation -->
    <nav class="fixed w-full bg-white/95 backdrop-blur-md z-50 border-b border-gray-100 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 283.467 283.467">
                        <path fill="#00008f" d="M.003.003h283.464v283.464H.003z"></path>
                        <path fill="#ff1721" d="M175.659 139.99 283.467 0h-15.923L159.38 139.99h16.279z"></path>
                        <path fill="#fff" d="M216.597 202.461c4.941 13.823 15.122 49.795 19.17 52.661h-26.729a44.571 44.571 0 0 0-1.254-9.434c-1.153-4.111-10.821-35.214-10.821-35.214h-42.456l-6.675 9.463s8.018 25.097 8.515 26.327c.865 2.217 4.693 8.858 4.693 8.858h-25.615s-.664-3.833-.913-5.43c-.2-1.289-2.427-8.349-2.427-8.349s-5.806 6.362-7.388 9.312c-1.596 2.943-2.304 4.467-2.304 4.467h-20.04s-.668-3.833-.917-5.43c-.196-1.289-2.647-8.916-2.647-8.916s-5.61 6.812-7.207 9.756c-1.587 2.95-2.27 4.59-2.27 4.59h-19.82s5.601-5.332 7.559-7.622c3.3-3.882 15.6-19.956 15.6-19.956l-4.931-17.07H45.586s-24.023 31.567-24.97 32.543c-.957.962-7.96 11.011-8.116 12.105H0v-7.949a5.987 5.987 0 0 1 .493-.479c.386-.283 18.213-22.412 34.59-44.233 14.717-19.029 28.526-37.535 29.737-39.297 2.934-4.263 7.163-13.467 7.163-13.467h21.781s.675 8.467 1.31 10.522c.565 1.817 13.837 45.362 14.15 45.831l7.338-9.385-12.543-38.614s-2.94-7.265-3.897-8.354h25.445a22.166 22.166 0 0 0 .83 6.919c1.034 3.184 6.489 22.866 6.489 22.866s17.354-21.753 18.369-23.315a14.1 14.1 0 0 0 2.143-6.47H174.6s-3.881 2.837-10.683 11.44c-2.285 2.896-24.673 31.348-24.673 31.348s1.953 6.66 2.905 9.976c.26.952.44 1.597.44 1.665 0 .03.493-.576 1.343-1.665 5.776-7.32 32.05-41.772 33.643-44.722 1.284-2.382 3.173-5.092 4.282-8.041h20.683s.478 6.176 1.109 7.885Zm-31.475-32.612c-3.037 6.533-20.913 28.296-20.913 28.296h28.31s-5.488-16.9-6.445-20.709a30.233 30.233 0 0 1-.557-7.402c0-.346-.063-.908-.395-.185Zm-108.775 0c-3.036 6.533-20.912 28.296-20.912 28.296h28.31s-5.483-16.9-6.44-20.709a30.233 30.233 0 0 1-.557-7.402c0-.346-.068-.908-.4-.185Zm42.623 65.986 7.793-10.703c-.718-.772-5.107-14.082-5.107-14.082l-7.535 9.775Z"></path>
                    </svg>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#services" class="text-gray-700 hover:text-[#00008F] px-3 py-2 text-sm font-medium">Services</a>
                    <a href="#process" class="text-gray-700 hover:text-[#00008F] px-3 py-2 text-sm font-medium">Processus</a>
                    <a href="#faq" class="text-gray-700 hover:text-[#00008F] px-3 py-2 text-sm font-medium">FAQ</a>
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn-primary">Tableau de bord</a>
                    @else
                        <a href="{{ route('login') }}" class="btn-primary">Connexion</a>
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden">
                    <button onclick="document.getElementById('mobile-menu').classList.toggle('hidden')" type="button" class="text-gray-700 hover:text-[#00008F] p-2">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-100">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="#services" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-[#00008F] hover:bg-gray-50 rounded-md">Services</a>
                <a href="#process" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-[#00008F] hover:bg-gray-50 rounded-md">Processus</a>
                <a href="#faq" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-[#00008F] hover:bg-gray-50 rounded-md">FAQ</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="block px-3 py-2 text-base font-medium text-white bg-[#00008F] hover:bg-[#0000CF] rounded-md">Tableau de bord</a>
                @else
                    <a href="{{ route('login') }}" class="block px-3 py-2 text-base font-medium text-white bg-[#00008F] hover:bg-[#0000CF] rounded-md">Connexion</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative overflow-hidden bg-white">
        <!-- Decorative background elements -->
        <div class="absolute inset-0 z-0">
            <div class="absolute -top-24 -right-20 w-96 h-96 rounded-full bg-gradient-to-br from-[#00008F]/10 to-[#FF1721]/10 blur-3xl"></div>
            <div class="absolute top-1/2 -left-32 w-96 h-96 rounded-full bg-gradient-to-tr from-[#00008F]/20 to-transparent blur-3xl"></div>
            <!-- Decorative lines -->
            <div class="absolute top-0 left-0 w-full h-full">
                <div class="absolute top-1/4 left-0 w-32 h-[1px] bg-gradient-to-r from-[#00008F]/30 to-transparent"></div>
                <div class="absolute top-1/3 right-0 w-32 h-[1px] bg-gradient-to-l from-[#00008F]/30 to-transparent"></div>
                <div class="absolute bottom-1/4 left-1/4 w-32 h-[1px] bg-gradient-to-r from-[#FF1721]/30 to-transparent rotate-45"></div>
            </div>
        </div>

        <!-- Content -->
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="relative z-10">
                    <div class="absolute -top-8 -left-8 w-20 h-20 bg-[#00008F]/5 rounded-full blur-lg"></div>
                    <h1 class="text-4xl font-bold tracking-tight sm:text-5xl md:text-6xl">
                        <span class="block bg-gradient-to-r from-[#00008F] to-[#FF1721] bg-clip-text text-transparent">
                            Gestion simplifiée
                                </span>
                        <span class="block text-gray-900 mt-2">de vos sinistres auto</span>
                    </h1>
                    <p class="mt-6 text-lg text-gray-600 max-w-3xl relative">
                        <span class="bg-gradient-to-r from-[#00008F]/10 to-transparent px-4 py-1 rounded-full">
                            Simplifiez la gestion de vos sinistres automobiles
                            </span>
                        avec notre plateforme intuitive. Déclaration rapide, suivi en temps réel et accompagnement personnalisé.
                    </p>
                    
                    <!-- Stats -->
                    <div class="mt-8 grid grid-cols-3 gap-4">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-[#00008F]">98%</div>
                            <div class="text-sm text-gray-600">Satisfaction</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-[#00008F]">24/7</div>
                            <div class="text-sm text-gray-600">Support</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-[#00008F]">48h</div>
                            <div class="text-sm text-gray-600">Traitement</div>
                        </div>
                    </div>

                    <div class="mt-10 flex gap-4 relative">
                        @auth
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-6 py-3 rounded-full text-white bg-gradient-to-r from-[#00008F] to-[#00008F]/90 hover:to-[#00008F] transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                                <span>Accéder à mon espace</span>
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                    </svg>
                                </a>
                        @else
                            <a href="{{ route('login') }}" class="inline-flex items-center px-6 py-3 rounded-full text-white bg-gradient-to-r from-[#00008F] to-[#00008F]/90 hover:to-[#00008F] transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                                <span>Commencer maintenant</span>
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                    </svg>
                                </a>
                            <a href="#process" class="inline-flex items-center px-6 py-3 rounded-full text-[#00008F] bg-white border-2 border-[#00008F]/10 hover:border-[#00008F]/30 transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                                En savoir plus
                            </a>
                        @endauth
                    </div>
                </div>
                <div class="hidden lg:block relative z-10">
                    <div class="relative">
                        <!-- Decorative elements around image -->
                        <div class="absolute -top-4 -right-4 w-72 h-72 bg-gradient-to-br from-[#00008F]/10 to-[#FF1721]/10 rounded-full blur-2xl"></div>
                        <div class="absolute -bottom-4 -left-4 w-72 h-72 bg-gradient-to-tr from-[#00008F]/10 to-transparent rounded-full blur-2xl"></div>
                        
                        <!-- Image container with gradient border -->
                        <div class="relative rounded-2xl overflow-hidden bg-gradient-to-br from-[#00008F] to-[#FF1721] p-1">
                            <img src="img/assurance.jpg" alt="Assurance auto" class="rounded-xl w-full h-auto object-cover transform hover:scale-105 transition-transform duration-500">
                        </div>
                        
                        <!-- Floating elements -->
                        <div class="absolute -right-6 top-1/4 bg-white rounded-lg shadow-xl p-4 transform rotate-3 hover:rotate-0 transition-transform duration-300">
                            <div class="flex items-center space-x-2">
                                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-sm font-medium">Traitement rapide</span>
                            </div>
                        </div>
                        
                        <div class="absolute -left-6 bottom-1/4 bg-white rounded-lg shadow-xl p-4 transform -rotate-3 hover:rotate-0 transition-transform duration-300">
                            <div class="flex items-center space-x-2">
                                <svg class="w-5 h-5 text-[#00008F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                                <span class="text-sm font-medium">100% Sécurisé</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Services Section -->
    <section id="services" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-bold text-gray-900">Nos Services de Gestion des Sinistres</h2>
                <p class="mt-4 text-lg text-gray-600">Une expertise complète pour tous types de sinistres automobiles</p>
            </div>
            <div class="mt-16 grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                <!-- Service 1: Accident de la Route -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <div class="relative h-48">
                        <img src="{{ asset('img/sinistre/Road_Accident.jpg') }}" alt="Accident de la route" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <div class="absolute bottom-4 left-4 text-white">
                            <h3 class="text-xl font-semibold">Collission de la Route</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600">Prise en charge rapide et efficace de vos accidents de la route. Assistance immédiate et accompagnement personnalisé dans vos démarches.</p>
                        <ul class="mt-4 space-y-2">
                            <li class="flex items-center text-sm text-gray-600">
                                <svg class="w-5 h-5 mr-2 text-[#00008F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Intervention rapide sur place
                            </li>
                            <li class="flex items-center text-sm text-gray-600">
                                <svg class="w-5 h-5 mr-2 text-[#00008F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Constat amiable assisté
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Service 2: Vandalisme -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <div class="relative h-48">
                        <img src="{{ asset('img/sinistre/Vehicle_Vandalism.jpg') }}" alt="Vandalisme" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <div class="absolute bottom-4 left-4 text-white">
                            <h3 class="text-xl font-semibold">Bris de glaces</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600">Protection complète contre les actes de vandalisme. Expertise détaillée des dommages et procédures de réparation accélérées.</p>
                        <ul class="mt-4 space-y-2">
                            <li class="flex items-center text-sm text-gray-600">
                                <svg class="w-5 h-5 mr-2 text-[#00008F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Expertise immédiate
                            </li>
                            <li class="flex items-center text-sm text-gray-600">
                                <svg class="w-5 h-5 mr-2 text-[#00008F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Réparations garanties
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Service 3: Incendie -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <div class="relative h-48">
                        <img src="{{ asset('img/sinistre/Vehicle_Fire.jpg') }}" alt="Incendie de véhicule" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <div class="absolute bottom-4 left-4 text-white">
                            <h3 class="text-xl font-semibold">Incendie et explosion </h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600">Gestion spécialisée des sinistres liés aux incendies de véhicules. Expertise technique approfondie et solutions adaptées.</p>
                        <ul class="mt-4 space-y-2">
                            <li class="flex items-center text-sm text-gray-600">
                                <svg class="w-5 h-5 mr-2 text-[#00008F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Expertise technique
                            </li>
                            <li class="flex items-center text-sm text-gray-600">
                                <svg class="w-5 h-5 mr-2 text-[#00008F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Prise en charge totale
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Service 4: Dommages Matériels -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <div class="relative h-48">
                        <img src="{{ asset('img/sinistre/Material_Damage.jpg') }}" alt="Dommages matériels" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <div class="absolute bottom-4 left-4 text-white">
                            <h3 class="text-xl font-semibold">Vandalisme et dégradations volontaires</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600">Évaluation précise et prise en charge des dommages matériels. Solutions de réparation optimisées et suivi personnalisé.</p>
                        <ul class="mt-4 space-y-2">
                            <li class="flex items-center text-sm text-gray-600">
                                <svg class="w-5 h-5 mr-2 text-[#00008F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Évaluation détaillée
                            </li>
                            <li class="flex items-center text-sm text-gray-600">
                                <svg class="w-5 h-5 mr-2 text-[#00008F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Réparations certifiées
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Service 5: Vol de Véhicule -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <div class="relative h-48">
                        <img src="{{ asset('img/sinistre/Vol_de_voiture.jpg') }}" alt="Vol de véhicule" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <div class="absolute bottom-4 left-4 text-white">
                            <h3 class="text-xl font-semibold">Vol et tentative de vol</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600">Assistance complète en cas de vol de véhicule. Procédures accélérées et accompagnement dans les démarches administratives.</p>
                        <ul class="mt-4 space-y-2">
                            <li class="flex items-center text-sm text-gray-600">
                                <svg class="w-5 h-5 mr-2 text-[#00008F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Assistance immédiate
                            </li>
                            <li class="flex items-center text-sm text-gray-600">
                                <svg class="w-5 h-5 mr-2 text-[#00008F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Suivi administratif
                        </li>
                    </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Process Section -->
    <section id="process" class="py-20 bg-white" x-data="{ activeStep: 0, isVisible: false }" x-intersect="isVisible = true">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Comment ça marche ?</h2>
                <p class="text-xl text-gray-600">Un processus simple et efficace pour gérer vos sinistres</p>
            </div>

            <!-- Process Timeline -->
            <div class="relative">
                <!-- Connection Line -->
                <div class="hidden md:block absolute top-1/2 left-0 w-full h-0.5 bg-gray-200 transform -translate-y-1/2"></div>
                <div class="hidden md:block process-line" :class="{ 'active': isVisible }"></div>

                <!-- Steps Container -->
                <div class="grid md:grid-cols-4 gap-12 relative">
                    <!-- Step 1 -->
                    <div class="relative group" x-intersect:enter="activeStep = 0">
                        <div class="flex flex-col items-center">
                            <div class="w-16 h-16 rounded-full bg-gradient-to-br from-[#00008F] to-[#FF1721] p-1 transform transition-transform duration-500 group-hover:scale-110 relative z-10">
                                <div class="w-full h-full rounded-full bg-white flex items-center justify-center">
                                    <span class="text-2xl font-bold bg-gradient-to-br from-[#00008F] to-[#FF1721] bg-clip-text text-transparent">1</span>
                                </div>
                            </div>
                            <div class="mt-6 text-center">
                                <h3 class="text-xl font-semibold text-gray-900 mb-2">Inscription</h3>
                                <p class="text-gray-600">Créez votre compte en quelques minutes et accédez à nos services</p>
                                <div class="mt-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <a href="{{ route('register') }}" class="inline-flex items-center text-[#00008F] hover:text-[#FF1721] transition-colors duration-300">
                                        <span>Commencer</span>
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="relative group" x-intersect:enter="activeStep = 1">
                        <div class="flex flex-col items-center">
                            <div class="w-16 h-16 rounded-full bg-gradient-to-br from-[#00008F] to-[#FF1721] p-1 transform transition-transform duration-500 group-hover:scale-110 relative z-10">
                                <div class="w-full h-full rounded-full bg-white flex items-center justify-center">
                                    <span class="text-2xl font-bold bg-gradient-to-br from-[#00008F] to-[#FF1721] bg-clip-text text-transparent">2</span>
                                </div>
                            </div>
                            <div class="mt-6 text-center">
                                <h3 class="text-xl font-semibold text-gray-900 mb-2">Déclaration</h3>
                                <p class="text-gray-600">Déclarez votre sinistre en ligne avec tous les détails nécessaires</p>
                                <div class="mt-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <span class="text-sm text-[#00008F]">Documentation simple et guidée</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="relative group" x-intersect:enter="activeStep = 2">
                        <div class="flex flex-col items-center">
                            <div class="w-16 h-16 rounded-full bg-gradient-to-br from-[#00008F] to-[#FF1721] p-1 transform transition-transform duration-500 group-hover:scale-110 relative z-10">
                                <div class="w-full h-full rounded-full bg-white flex items-center justify-center">
                                    <span class="text-2xl font-bold bg-gradient-to-br from-[#00008F] to-[#FF1721] bg-clip-text text-transparent">3</span>
                                </div>
                            </div>
                            <div class="mt-6 text-center">
                                <h3 class="text-xl font-semibold text-gray-900 mb-2">Traitement</h3>
                                <p class="text-gray-600">Notre équipe analyse votre dossier et valide votre déclaration</p>
                                <div class="mt-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <span class="text-sm text-[#00008F]">Suivi en temps réel</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 4 -->
                    <div class="relative group" x-intersect:enter="activeStep = 3">
                        <div class="flex flex-col items-center">
                            <div class="w-16 h-16 rounded-full bg-gradient-to-br from-[#00008F] to-[#FF1721] p-1 transform transition-transform duration-500 group-hover:scale-110 relative z-10">
                                <div class="w-full h-full rounded-full bg-white flex items-center justify-center">
                                    <span class="text-2xl font-bold bg-gradient-to-br from-[#00008F] to-[#FF1721] bg-clip-text text-transparent">4</span>
                                </div>
                            </div>
                            <div class="mt-6 text-center">
                                <h3 class="text-xl font-semibold text-gray-900 mb-2">Résolution</h3>
                                <p class="text-gray-600">Votre sinistre est pris en charge et résolu rapidement</p>
                                <div class="mt-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <span class="text-sm text-[#00008F]">Satisfaction garantie</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Features Grid -->
                <div id="features" class="mt-20 grid md:grid-cols-3 gap-8">
                    <div class="bg-white rounded-xl p-6 shadow-lg hover:shadow-xl transition-shadow duration-300 transform hover:-translate-y-1">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-[#00008F]/10 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-[#00008F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                            </div>
                            <h4 class="ml-4 text-lg font-semibold">Traitement Rapide</h4>
                        </div>
                        <p class="text-gray-600">Résolution de votre sinistre en 48h en moyenne après réception du dossier complet</p>
                    </div>

                    <div class="bg-white rounded-xl p-6 shadow-lg hover:shadow-xl transition-shadow duration-300 transform hover:-translate-y-1">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-[#00008F]/10 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-[#00008F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                            </div>
                            <h4 class="ml-4 text-lg font-semibold">100% Sécurisé</h4>
                        </div>
                        <p class="text-gray-600">Vos données sont protégées et traitées de manière confidentielle</p>
                    </div>

                    <div class="bg-white rounded-xl p-6 shadow-lg hover:shadow-xl transition-shadow duration-300 transform hover:-translate-y-1">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-[#00008F]/10 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-[#00008F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path>
                    </svg>
                            </div>
                            <h4 class="ml-4 text-lg font-semibold">Support 24/7</h4>
                        </div>
                        <p class="text-gray-600">Une équipe dédiée à votre écoute pour vous accompagner à chaque étape</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 283.467 283.467"><path fill="#00008f" d="M.003.003h283.464v283.464H.003z"></path><path fill="#ff1721" d="M175.659 139.99 283.467 0h-15.923L159.38 139.99h16.279z"></path><path fill="#fff" d="M216.597 202.461c4.941 13.823 15.122 49.795 19.17 52.661h-26.729a44.571 44.571 0 0 0-1.254-9.434c-1.153-4.111-10.821-35.214-10.821-35.214h-42.456l-6.675 9.463s8.018 25.097 8.515 26.327c.865 2.217 4.693 8.858 4.693 8.858h-25.615s-.664-3.833-.913-5.43c-.2-1.289-2.427-8.349-2.427-8.349s-5.806 6.362-7.388 9.312c-1.596 2.943-2.304 4.467-2.304 4.467h-20.04s-.668-3.833-.917-5.43c-.196-1.289-2.647-8.916-2.647-8.916s-5.61 6.812-7.207 9.756c-1.587 2.95-2.27 4.59-2.27 4.59h-19.82s5.601-5.332 7.559-7.622c3.3-3.882 15.6-19.956 15.6-19.956l-4.931-17.07H45.586s-24.023 31.567-24.97 32.543c-.957.962-7.96 11.011-8.116 12.105H0v-7.949a5.987 5.987 0 0 1 .493-.479c.386-.283 18.213-22.412 34.59-44.233 14.717-19.029 28.526-37.535 29.737-39.297 2.934-4.263 7.163-13.467 7.163-13.467h21.781s.675 8.467 1.31 10.522c.565 1.817 13.837 45.362 14.15 45.831l7.338-9.385-12.543-38.614s-2.94-7.265-3.897-8.354h25.445a22.166 22.166 0 0 0 .83 6.919c1.034 3.184 6.489 22.866 6.489 22.866s17.354-21.753 18.369-23.315a14.1 14.1 0 0 0 2.143-6.47H174.6s-3.881 2.837-10.683 11.44c-2.285 2.896-24.673 31.348-24.673 31.348s1.953 6.66 2.905 9.976c.26.952.44 1.597.44 1.665 0 .03.493-.576 1.343-1.665 5.776-7.32 32.05-41.772 33.643-44.722 1.284-2.382 3.173-5.092 4.282-8.041h20.683s.478 6.176 1.109 7.885Zm-31.475-32.612c-3.037 6.533-20.913 28.296-20.913 28.296h28.31s-5.488-16.9-6.445-20.709a30.233 30.233 0 0 1-.557-7.402c0-.346-.063-.908-.395-.185Zm-108.775 0c-3.036 6.533-20.912 28.296-20.912 28.296h28.31s-5.483-16.9-6.44-20.709a30.233 30.233 0 0 1-.557-7.402c0-.346-.068-.908-.4-.185Zm42.623 65.986 7.793-10.703c-.718-.772-5.107-14.082-5.107-14.082l-7.535 9.775Z"></path>
                        </svg>
                        <span class="text-xl font-bold">Sinistre Auto</span>
                    </div>
                    <p class="mt-4 text-gray-400">Votre partenaire de confiance pour la gestion des sinistres automobiles.</p>
    </div>

                <div>
                    <h3 class="text-sm font-semibold uppercase tracking-wider">Navigation</h3>
                    <ul class="mt-4 space-y-2">
                        <li><a href="#services" class="text-gray-400 hover:text-white">Services</a></li>
                        <li><a href="#process" class="text-gray-400 hover:text-white">Processus</a></li>
                        <li><a href="#faq" class="text-gray-400 hover:text-white">FAQ</a></li>
                    </ul>
                </div>

                        <div>
                    <h3 class="text-sm font-semibold uppercase tracking-wider">Légal</h3>
                    <ul class="mt-4 space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white">Mentions légales</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Politique de confidentialité</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">CGU</a></li>
                            </ul>
        </div>

                <div>
                    <h3 class="text-sm font-semibold uppercase tracking-wider">Contact</h3>
                    <ul class="mt-4 space-y-2">
                        <li class="text-gray-400">contact@sinistre-auto.fr</li>
                        <li class="text-gray-400">01 23 45 67 89</li>
                        <li class="text-gray-400">Du lundi au vendredi<br>9h00 - 18h00</li>
                            </ul>
                        </div>
                    </div>
            <div class="mt-12 border-t border-gray-800 pt-8">
                <p class="text-gray-400 text-sm text-center">&copy; {{ date('Y') }} Sinistre Auto. Tous droits réservés.</p>
            </div>
        </div>
    </footer>
    </body>
</html>