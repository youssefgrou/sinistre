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
            
            /* Premium Animations */
            @keyframes gradientFlow {
                0% { background-position: 0% 50%; }
                50% { background-position: 100% 50%; }
                100% { background-position: 0% 50%; }
            }

            @keyframes float {
                0% { transform: translateY(0px); }
                50% { transform: translateY(-20px); }
                100% { transform: translateY(0px); }
            }

            @keyframes shine {
                0% { background-position: -100% 0; }
                100% { background-position: 200% 0; }
            }

            @keyframes slideUp {
                from { transform: translateY(50px); opacity: 0; }
                to { transform: translateY(0); opacity: 1; }
            }

            @keyframes slideIn {
                from { transform: translateX(-100px); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }

            @keyframes fadeIn {
                from { opacity: 0; }
                to { opacity: 1; }
            }

            /* Premium Styles */
            .premium-gradient {
                background: linear-gradient(-45deg, #00008F, #0000CF, #FF1721, #00008F);
                background-size: 400% 400%;
                animation: gradientFlow 15s ease infinite;
            }

            .premium-text {
                background: linear-gradient(90deg, #00008F, #0000CF, #FF1721);
                background-size: 200% auto;
                -webkit-background-clip: text;
                background-clip: text;
                color: transparent;
                animation: shine 3s linear infinite;
            }

            .premium-card {
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.2);
                box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
                transition: all 0.3s ease;
            }

            .premium-card:hover {
                transform: translateY(-10px);
                box-shadow: 0 15px 45px 0 rgba(31, 38, 135, 0.5);
            }

            .premium-button {
                background: linear-gradient(45deg, #00008F, #0000CF);
                border: none;
                color: white;
                padding: 12px 30px;
                border-radius: 8px;
                position: relative;
                overflow: hidden;
                transition: all 0.3s ease;
            }

            .premium-button::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
                transition: 0.5s;
            }

            .premium-button:hover::before {
                left: 100%;
            }

            .premium-button:hover {
                transform: translateY(-3px);
                box-shadow: 0 10px 20px rgba(0,0,128,0.2);
            }

            .premium-nav {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(10px);
                border-bottom: 1px solid rgba(255, 255, 255, 0.2);
                transition: all 0.3s ease;
            }

            .premium-nav.scrolled {
                background: rgba(255, 255, 255, 0.98);
                box-shadow: 0 2px 20px rgba(0,0,128,0.1);
            }

            .premium-section {
                position: relative;
                overflow: hidden;
            }

            .premium-section::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: linear-gradient(45deg, rgba(0,0,143,0.05), rgba(0,0,207,0.05));
                z-index: 0;
            }

            .premium-image {
                transition: all 0.5s ease;
                filter: brightness(1);
            }

            .premium-image:hover {
                transform: scale(1.05);
                filter: brightness(1.1);
            }

            .premium-text-animate {
                opacity: 0;
                transform: translateY(20px);
                transition: all 0.6s ease;
            }

            .premium-text-animate.visible {
                opacity: 1;
                transform: translateY(0);
            }

            .premium-grid {
                display: grid;
                gap: 2rem;
                grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            }

            .premium-feature {
                position: relative;
                padding: 2rem;
                background: white;
                border-radius: 1rem;
                overflow: hidden;
                transition: all 0.3s ease;
            }

            .premium-feature::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: linear-gradient(45deg, transparent, rgba(0,0,143,0.05), transparent);
                transform: translateX(-100%);
                transition: 0.5s;
            }

            .premium-feature:hover::before {
                transform: translateX(100%);
            }

            .premium-feature:hover {
                transform: translateY(-5px);
                box-shadow: 0 10px 30px rgba(0,0,128,0.1);
            }

            /* Scroll Progress Bar */
            .scroll-progress {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 3px;
                background: linear-gradient(to right, #00008F, #0000CF);
                transform-origin: 0%;
                z-index: 1000;
            }

            /* Loading Animation */
            .loading-overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: white;
                display: flex;
                justify-content: center;
                align-items: center;
                z-index: 9999;
                transition: opacity 0.5s ease;
            }

            .loading-spinner {
                width: 50px;
                height: 50px;
                border: 3px solid #f3f3f3;
                border-top: 3px solid #00008F;
                border-radius: 50%;
                animation: spin 1s linear infinite;
            }

            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }

            /* Enhanced Section Animations */
            @keyframes slideInFromLeft {
                from {
                    transform: translateX(-100px);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }

            @keyframes slideInFromRight {
                from {
                    transform: translateX(100px);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }

            @keyframes slideInFromBottom {
                from {
                    transform: translateY(50px);
                    opacity: 0;
                }
                to {
                    transform: translateY(0);
                    opacity: 1;
                }
            }

            @keyframes scaleIn {
                from {
                    transform: scale(0.9);
                    opacity: 0;
                }
                to {
                    transform: scale(1);
                    opacity: 1;
                }
            }

            @keyframes rotateIn {
                from {
                    transform: rotate(-10deg) scale(0.9);
                    opacity: 0;
                }
                to {
                    transform: rotate(0) scale(1);
                    opacity: 1;
                }
            }

            /* Section Animation Classes */
            .section-animate {
                opacity: 0;
                transform: translateY(30px);
                transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .section-animate.visible {
                opacity: 1;
                transform: translateY(0);
            }

            .section-animate-left {
                opacity: 0;
                transform: translateX(-50px);
                transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .section-animate-left.visible {
                opacity: 1;
                transform: translateX(0);
            }

            .section-animate-right {
                opacity: 0;
                transform: translateX(50px);
                transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .section-animate-right.visible {
                opacity: 1;
                transform: translateX(0);
            }

            .section-animate-scale {
                opacity: 0;
                transform: scale(0.95);
                transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .section-animate-scale.visible {
                opacity: 1;
                transform: scale(1);
            }

            .section-animate-rotate {
                opacity: 0;
                transform: rotate(-5deg) scale(0.95);
                transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .section-animate-rotate.visible {
                opacity: 1;
                transform: rotate(0) scale(1);
            }

            /* Enhanced Card Animations */
            .card-animate {
                opacity: 0;
                transform: translateY(30px);
                transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .card-animate.visible {
                opacity: 1;
                transform: translateY(0);
            }

            .card-animate:nth-child(1) { transition-delay: 0.1s; }
            .card-animate:nth-child(2) { transition-delay: 0.2s; }
            .card-animate:nth-child(3) { transition-delay: 0.3s; }
            .card-animate:nth-child(4) { transition-delay: 0.4s; }
            .card-animate:nth-child(5) { transition-delay: 0.5s; }

            /* Enhanced Image Animations */
            .image-animate {
                opacity: 0;
                transform: scale(0.95);
                transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .image-animate.visible {
                opacity: 1;
                transform: scale(1);
            }

            /* Enhanced Text Animations */
            .text-animate {
                opacity: 0;
                transform: translateY(20px);
                transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .text-animate.visible {
                opacity: 1;
                transform: translateY(0);
            }

            /* Enhanced Button Animations */
            .button-animate {
                opacity: 0;
                transform: translateY(20px);
                transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .button-animate.visible {
                opacity: 1;
                transform: translateY(0);
            }

            /* Enhanced Process Step Animations */
            .step-animate {
                opacity: 0;
                transform: translateY(30px);
                transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .step-animate.visible {
                opacity: 1;
                transform: translateY(0);
            }

            .step-animate:nth-child(1) { transition-delay: 0.1s; }
            .step-animate:nth-child(2) { transition-delay: 0.2s; }
            .step-animate:nth-child(3) { transition-delay: 0.3s; }
            .step-animate:nth-child(4) { transition-delay: 0.4s; }

            /* Enhanced Feature Animations */
            .feature-animate {
                opacity: 0;
                transform: translateY(30px);
                transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .feature-animate.visible {
                opacity: 1;
                transform: translateY(0);
            }

            .feature-animate:nth-child(1) { transition-delay: 0.1s; }
            .feature-animate:nth-child(2) { transition-delay: 0.2s; }
            .feature-animate:nth-child(3) { transition-delay: 0.3s; }
        </style>
    </head>
    <body class="antialiased bg-gray-50">
        <!-- Loading Overlay -->
        <div id="loading-overlay" class="loading-overlay">
            <div class="loading-spinner"></div>
        </div>

        <!-- Scroll Progress Bar -->
        <div id="scroll-progress" class="scroll-progress"></div>

        <!-- Navigation -->
        <nav class="premium-nav fixed w-full z-50">
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
        <div class="premium-section relative overflow-hidden bg-white">
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
                        <h1 class="text-4xl font-bold tracking-tight sm:text-5xl md:text-6xl section-animate">
                            <span class="block bg-gradient-to-r from-[#00008F] to-[#FF1721] bg-clip-text text-transparent">
                                Gestion simplifiée
                            </span>
                            <span class="block text-gray-900 mt-2">de vos sinistres auto</span>
                        </h1>
                        <p class="mt-6 text-lg text-gray-600 max-w-3xl relative section-animate-left">
                            <span class="bg-gradient-to-r from-[#00008F]/10 to-transparent px-4 py-1 rounded-full">
                                "Simplifiez la gestion de vos sinistres automobiles
                            </span>
                            avec notre plateforme intuitive. Déclaration rapide, suivi en temps réel et recevez un accompagnement personnalisé à chaque étape."
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
        <section id="services" class="premium-section py-20 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h2 class="text-3xl font-bold text-gray-900 section-animate">Notre garantie : une gestion transparente et réactive de vos sinistres</h2>
                    <p class="mt-4 text-lg text-gray-600 section-animate">Une expertise complète pour tous types de sinistres automobiles</p>
                </div>
                <div class="mt-16 grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                    <!-- Service 1: Accident de la Route -->
                    <div class="card-animate bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
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
                    <div class="card-animate bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
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
                    <div class="card-animate bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
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
                    <div class="card-animate bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
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
                    <div class="card-animate bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
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
        <section id="process" class="py-12 sm:py-16 md:py-24 bg-gradient-to-b from-white to-gray-50/50 relative overflow-hidden">
            <!-- Floating Elements - Hidden on mobile for better performance -->
            <div class="hidden md:block absolute inset-0 pointer-events-none">
                <div class="absolute top-1/4 left-1/4 w-64 h-64 bg-[#00008F]/5 rounded-full blur-3xl animate-pulse"></div>
                <div class="absolute bottom-1/4 right-1/4 w-64 h-64 bg-[#FF1721]/5 rounded-full blur-3xl animate-pulse delay-1000"></div>
            </div>

            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative">
                <!-- Section Header - Adjusted spacing for mobile -->
                <div class="text-center max-w-3xl mx-auto mb-8 sm:mb-12 md:mb-16 px-4">
                    <span class="text-[#00008F] bg-[#00008F]/5 px-3 py-1 rounded-full text-sm font-medium inline-block mb-3 sm:mb-4">Notre processus</span>
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 mb-3 sm:mb-4">Comment ça marche ?</h2>
                    <p class="text-base sm:text-lg text-gray-600 px-4">Nous avons simplifié le processus de gestion de sinistre en 4 étapes faciles</p>
                </div>

                <!-- Process Steps - Enhanced mobile grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 lg:gap-8 relative">
                    <!-- Connection Lines (Desktop only) -->
                    <div class="hidden lg:block absolute top-1/3 left-0 w-full h-0.5 bg-gradient-to-r from-[#00008F]/0 via-[#00008F]/20 to-[#00008F]/0"></div>

                    <!-- Step 1 - Mobile optimized -->
                    <div class="group relative bg-white rounded-xl sm:rounded-2xl p-4 sm:p-6 transition-all duration-300 hover:shadow-xl hover:-translate-y-1 border border-gray-100">
                        <div class="absolute inset-0 bg-gradient-to-br from-[#00008F]/5 to-transparent opacity-0 group-hover:opacity-100 rounded-xl sm:rounded-2xl transition-opacity duration-300"></div>
                        
                        <!-- Step Number - Adjusted for mobile -->
                        <div class="flex items-center mb-4 sm:mb-6">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-[#00008F]/10 flex items-center justify-center text-[#00008F] text-lg sm:text-xl font-bold group-hover:scale-110 transition-transform duration-300">1</div>
                            <div class="ml-3 sm:ml-4">
                                <h3 class="text-lg sm:text-xl font-bold text-gray-900">Inscription</h3>
                            </div>
                        </div>

                        <p class="text-sm sm:text-base text-gray-600 mb-4 sm:mb-6">Créez votre compte en quelques clics et accédez à notre plateforme sécurisée</p>

                        <!-- Features - Mobile optimized spacing -->
                        <ul class="space-y-2 sm:space-y-3 mb-4 sm:mb-6">
                            <li class="flex items-center text-sm sm:text-base text-gray-600">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 sm:mr-3 text-[#00008F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Inscription rapide</span>
                            </li>
                            <li class="flex items-center text-sm sm:text-base text-gray-600">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 sm:mr-3 text-[#00008F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>100% en ligne</span>
                            </li>
                        </ul>

                        <a href="{{ route('register') }}" class="inline-flex items-center text-sm sm:text-base text-[#00008F] hover:text-[#FF1721] transition-colors duration-300 group">
                            <span>Commencer</span>
                            <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>

                    <!-- Step 2 - Mobile optimized -->
                    <div class="group relative bg-white rounded-xl sm:rounded-2xl p-4 sm:p-6 transition-all duration-300 hover:shadow-xl hover:-translate-y-1 border border-gray-100">
                        <div class="absolute inset-0 bg-gradient-to-br from-[#00008F]/5 to-transparent opacity-0 group-hover:opacity-100 rounded-xl sm:rounded-2xl transition-opacity duration-300"></div>
                        
                        <!-- Step Number -->
                        <div class="flex items-center mb-4 sm:mb-6">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-[#00008F]/10 flex items-center justify-center text-[#00008F] text-lg sm:text-xl font-bold group-hover:scale-110 transition-transform duration-300">2</div>
                            <div class="ml-3 sm:ml-4">
                                <h3 class="text-lg sm:text-xl font-bold text-gray-900">Déclaration</h3>
                            </div>
                        </div>

                        <p class="text-sm sm:text-base text-gray-600 mb-4 sm:mb-6">Déclarez votre sinistre facilement avec notre formulaire guidé</p>

                        <!-- Features -->
                        <ul class="space-y-2 sm:space-y-3 mb-4 sm:mb-6">
                            <li class="flex items-center text-sm sm:text-base text-gray-600">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 sm:mr-3 text-[#00008F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Formulaire intuitif</span>
                            </li>
                            <li class="flex items-center text-sm sm:text-base text-gray-600">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 sm:mr-3 text-[#00008F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Assistance en direct</span>
                            </li>
                        </ul>

                        <span class="inline-flex items-center px-2 sm:px-3 py-1 rounded-full bg-[#00008F]/5 text-[#00008F] text-xs sm:text-sm">
                            <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1 sm:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Guide étape par étape
                        </span>
                    </div>

                    <!-- Step 3 - Mobile optimized -->
                    <div class="group relative bg-white rounded-xl sm:rounded-2xl p-4 sm:p-6 transition-all duration-300 hover:shadow-xl hover:-translate-y-1 border border-gray-100">
                        <div class="absolute inset-0 bg-gradient-to-br from-[#00008F]/5 to-transparent opacity-0 group-hover:opacity-100 rounded-xl sm:rounded-2xl transition-opacity duration-300"></div>
                        
                        <!-- Step Number -->
                        <div class="flex items-center mb-4 sm:mb-6">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-[#00008F]/10 flex items-center justify-center text-[#00008F] text-lg sm:text-xl font-bold group-hover:scale-110 transition-transform duration-300">3</div>
                            <div class="ml-3 sm:ml-4">
                                <h3 class="text-lg sm:text-xl font-bold text-gray-900">Traitement</h3>
                            </div>
                        </div>

                        <p class="text-sm sm:text-base text-gray-600 mb-4 sm:mb-6">Suivez l'avancement de votre dossier en temps réel</p>

                        <!-- Features -->
                        <ul class="space-y-2 sm:space-y-3 mb-4 sm:mb-6">
                            <li class="flex items-center text-sm sm:text-base text-gray-600">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 sm:mr-3 text-[#00008F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Suivi en direct</span>
                            </li>
                            <li class="flex items-center text-sm sm:text-base text-gray-600">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 sm:mr-3 text-[#00008F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Notifications instantanées</span>
                            </li>
                        </ul>

                        <span class="inline-flex items-center px-2 sm:px-3 py-1 rounded-full bg-[#00008F]/5 text-[#00008F] text-xs sm:text-sm">
                            <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1 sm:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Traitement sous 48h
                        </span>
                    </div>

                    <!-- Step 4 - Mobile optimized -->
                    <div class="group relative bg-white rounded-xl sm:rounded-2xl p-4 sm:p-6 transition-all duration-300 hover:shadow-xl hover:-translate-y-1 border border-gray-100">
                        <div class="absolute inset-0 bg-gradient-to-br from-[#00008F]/5 to-transparent opacity-0 group-hover:opacity-100 rounded-xl sm:rounded-2xl transition-opacity duration-300"></div>
                        
                        <!-- Step Number -->
                        <div class="flex items-center mb-4 sm:mb-6">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-[#00008F]/10 flex items-center justify-center text-[#00008F] text-lg sm:text-xl font-bold group-hover:scale-110 transition-transform duration-300">4</div>
                            <div class="ml-3 sm:ml-4">
                                <h3 class="text-lg sm:text-xl font-bold text-gray-900">Résolution</h3>
                            </div>
                        </div>

                        <p class="text-sm sm:text-base text-gray-600 mb-4 sm:mb-6">Votre sinistre est résolu rapidement et efficacement</p>

                        <!-- Features -->
                        <ul class="space-y-2 sm:space-y-3 mb-4 sm:mb-6">
                            <li class="flex items-center text-sm sm:text-base text-gray-600">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 sm:mr-3 text-[#00008F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Prise en charge rapide</span>
                            </li>
                            <li class="flex items-center text-sm sm:text-base text-gray-600">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 sm:mr-3 text-[#00008F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Satisfaction garantie</span>
                            </li>
                        </ul>

                        <span class="inline-flex items-center px-2 sm:px-3 py-1 rounded-full bg-green-50 text-green-600 text-xs sm:text-sm">
                            <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1 sm:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Dossier finalisé
                        </span>
                    </div>
                </div>

                <!-- Bottom Features - Mobile optimized -->
                <div class="mt-8 sm:mt-12 md:mt-16 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 sm:gap-6 md:gap-8">
                    <!-- Feature 1 -->
                    <div class="bg-white rounded-xl p-4 sm:p-6 shadow-sm hover:shadow-md transition-shadow duration-300 border border-gray-100">
                        <div class="flex items-center space-x-3 sm:space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-[#00008F]/10 flex items-center justify-center">
                                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-[#00008F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h4 class="text-base sm:text-lg font-semibold text-gray-900">Traitement Rapide</h4>
                                <p class="text-xs sm:text-sm text-gray-600 mt-1">Résolution en 48h après réception</p>
                            </div>
                        </div>
                    </div>

                    <!-- Feature 2 -->
                    <div class="bg-white rounded-xl p-4 sm:p-6 shadow-sm hover:shadow-md transition-shadow duration-300 border border-gray-100">
                        <div class="flex items-center space-x-3 sm:space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-[#00008F]/10 flex items-center justify-center">
                                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-[#00008F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h4 class="text-base sm:text-lg font-semibold text-gray-900">100% Sécurisé</h4>
                                <p class="text-xs sm:text-sm text-gray-600 mt-1">Vos données sont protégées</p>
                            </div>
                        </div>
                    </div>

                    <!-- Feature 3 -->
                    <div class="bg-white rounded-xl p-4 sm:p-6 shadow-sm hover:shadow-md transition-shadow duration-300 border border-gray-100">
                        <div class="flex items-center space-x-3 sm:space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-[#00008F]/10 flex items-center justify-center">
                                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-[#00008F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h4 class="text-base sm:text-lg font-semibold text-gray-900">Support 24/7</h4>
                                <p class="text-xs sm:text-sm text-gray-600 mt-1">Assistance permanente</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="premium-section bg-gray-900 text-white">
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
        </footer>

        <script>
            // Loading Animation
            window.addEventListener('load', function() {
                const overlay = document.getElementById('loading-overlay');
                overlay.style.opacity = '0';
                setTimeout(() => {
                    overlay.style.display = 'none';
                }, 500);
            });

            // Scroll Progress Bar
            window.addEventListener('scroll', function() {
                const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
                const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
                const scrolled = (winScroll / height) * 100;
                document.getElementById('scroll-progress').style.transform = `scaleX(${scrolled / 100})`;
            });

            // Navbar Scroll Effect
            window.addEventListener('scroll', function() {
                const nav = document.querySelector('.premium-nav');
                if (window.scrollY > 50) {
                    nav.classList.add('scrolled');
                } else {
                    nav.classList.remove('scrolled');
                }
            });

            // Text Animation on Scroll
            const observerOptions = {
                threshold: 0.1
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.premium-text-animate').forEach((element) => {
                observer.observe(element);
            });

            // Enhanced Scroll Animations
            const scrollAnimations = () => {
                const elements = document.querySelectorAll('.section-animate, .section-animate-left, .section-animate-right, .section-animate-scale, .section-animate-rotate, .card-animate, .image-animate, .text-animate, .button-animate, .step-animate, .feature-animate');
                
                elements.forEach(element => {
                    const elementTop = element.getBoundingClientRect().top;
                    const elementBottom = element.getBoundingClientRect().bottom;
                    
                    if (elementTop < window.innerHeight && elementBottom > 0) {
                        element.classList.add('visible');
                    }
                });
            };

            // Initial check for elements in view
            scrollAnimations();

            // Check on scroll
            window.addEventListener('scroll', scrollAnimations);

            // Check on resize
            window.addEventListener('resize', scrollAnimations);

            // Smooth scroll for navigation links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        </script>
    </body>
</html>