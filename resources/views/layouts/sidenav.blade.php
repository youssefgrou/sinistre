<!-- Side Navigation -->
<div class="relative lg:flex lg:flex-col" x-data="{ open: false }">
    <!-- Mobile backdrop -->
    <div x-show="open" 
         x-transition:enter="transition-opacity ease-in-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-in-out duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-gray-600 bg-opacity-75 z-20 lg:hidden"
         @click="open = false">
    </div>

    <aside class="fixed inset-y-0 left-0 bg-white w-64 border-r border-gray-200 shadow-sm z-30 transform transition-transform duration-300 ease-in-out lg:translate-x-0" 
           :class="{'translate-x-0': open, '-translate-x-full': !open}">
        
        <!-- Logo section -->
        <div class="h-16 flex items-center justify-between px-4 border-b border-gray-200">
            <div class="flex items-center">
                <x-application-logo class="h-10 w-auto" />
            </div>
            <button @click="open = false" class="lg:hidden p-2 rounded-md hover:bg-gray-100">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Navigation Links -->
        <nav class="mt-6 px-4 space-y-2">
            <!-- Dashboard -->
            <a href="{{ route('client.dashboard') }}" 
               class="flex items-center px-4 py-2 text-gray-700 hover:bg-[#00008f] hover:text-white rounded-lg transition-colors duration-200 {{ request()->routeIs('client.dashboard') ? 'bg-[#00008f] text-white' : '' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span>Tableau de bord</span>
            </a>

            <!-- Declare New Claim -->
            <a href="{{ route('client.sinistres.create') }}" 
               class="flex items-center px-4 py-2 text-gray-700 hover:bg-[#00008f] hover:text-white rounded-lg transition-colors duration-200 {{ request()->routeIs('client.sinistres.create') ? 'bg-[#00008f] text-white' : '' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span>Déclarer un sinistre</span>
            </a>

            <!-- My Claims -->
            <a href="{{ route('client.sinistres.index') }}" 
               class="flex items-center px-4 py-2 text-gray-700 hover:bg-[#00008f] hover:text-white rounded-lg transition-colors duration-200 {{ request()->routeIs('client.sinistres.index') ? 'bg-[#00008f] text-white' : '' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <span>Mes sinistres</span>
            </a>

            <!-- Profile -->
            <a href="{{ route('profile.edit') }}" 
               class="flex items-center px-4 py-2 text-gray-700 hover:bg-[#00008f] hover:text-white rounded-lg transition-colors duration-200 {{ request()->routeIs('profile.edit') ? 'bg-[#00008f] text-white' : '' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span>Mon profil</span>
            </a>
        </nav>

        <!-- User Info -->
        <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-gray-200">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="w-8 h-8 text-gray-400 bg-gray-100 rounded-full p-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-gray-900 truncate">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-gray-500 truncate">{{ auth()->user()->email }}</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="mt-4">
                @csrf
                <button type="submit" class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-[#00008f] rounded-lg transition-colors duration-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    <span>Se déconnecter</span>
                </button>
            </form>
        </div>
    </aside>
</div>

<!-- Mobile Navigation Toggle -->
<div class="fixed lg:hidden bottom-4 left-4 z-40">
    <button id="mobileMenuButton"
            class="bg-[#00008f] text-white p-3 rounded-full shadow-lg hover:bg-[#000066] transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#00008f]">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuButton = document.getElementById('mobileMenuButton');
        const sidebar = document.querySelector('aside');
        const backdrop = document.querySelector('[x-show="open"]');
        let isOpen = false;

        function toggleMenu() {
            isOpen = !isOpen;
            if (isOpen) {
                sidebar.classList.remove('-translate-x-full');
                sidebar.classList.add('translate-x-0');
                backdrop.style.display = 'block';
            } else {
                sidebar.classList.remove('translate-x-0');
                sidebar.classList.add('-translate-x-full');
                backdrop.style.display = 'none';
            }
        }

        mobileMenuButton.addEventListener('click', toggleMenu);
        backdrop.addEventListener('click', () => {
            isOpen = false;
            sidebar.classList.remove('translate-x-0');
            sidebar.classList.add('-translate-x-full');
            backdrop.style.display = 'none';
        });
    });
</script> 