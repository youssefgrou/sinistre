<!-- Side Navigation -->
<div class="fixed inset-y-0 left-0 w-64 bg-white border-r border-gray-200 z-30 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out flex flex-col">
    <!-- Logo section -->
    <div class="h-16 flex items-center px-4 border-b border-gray-200 flex-shrink-0">
        <div class="flex items-center">
            <x-application-logo class="block h-10 w-auto fill-current text-gray-800" />
        </div>
    </div>

    <!-- Navigation Links -->
    <nav class="flex-1 px-2 py-4 space-y-1 overflow-y-auto">
        @if(auth()->user()->isAdmin())
            <!-- Admin Navigation -->
            <a href="{{ route('admin.dashboard') }}" 
               class="flex items-center px-4 py-2 text-sm font-medium {{ request()->routeIs('admin.dashboard') ? 'text-white bg-[#00008f]' : 'text-gray-600 hover:bg-[#00008f] hover:text-white' }} rounded-lg transition-colors duration-200">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Tableau de bord
            </a>

            <a href="{{ route('admin.sinistres.index') }}" 
               class="flex items-center px-4 py-2 text-sm font-medium {{ request()->routeIs('admin.sinistres.*') ? 'text-white bg-[#00008f]' : 'text-gray-600 hover:bg-[#00008f] hover:text-white' }} rounded-lg transition-colors duration-200">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                Mes sinistres
            </a>
        @else
            <!-- Client Navigation -->
            <a href="{{ route('client.dashboard') }}" 
               class="flex items-center px-4 py-2 text-sm font-medium {{ request()->routeIs('client.dashboard') ? 'text-white bg-[#00008f]' : 'text-gray-600 hover:bg-[#00008f] hover:text-white' }} rounded-lg transition-colors duration-200">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Tableau de bord
            </a>

            <a href="{{ route('client.sinistres.create') }}" 
               class="flex items-center px-4 py-2 text-sm font-medium {{ request()->routeIs('client.sinistres.create') ? 'text-white bg-[#00008f]' : 'text-gray-600 hover:bg-[#00008f] hover:text-white' }} rounded-lg transition-colors duration-200">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Déclarer un sinistre
            </a>

            <a href="{{ route('client.sinistres.index') }}" 
               class="flex items-center px-4 py-2 text-sm font-medium {{ request()->routeIs('client.sinistres.index') ? 'text-white bg-[#00008f]' : 'text-gray-600 hover:bg-[#00008f] hover:text-white' }} rounded-lg transition-colors duration-200">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                Mes sinistres
            </a>
        @endif

        <!-- Common Navigation Items -->
        <a href="{{ route('profile.edit') }}" 
           class="flex items-center px-4 py-2 text-sm font-medium {{ request()->routeIs('profile.edit') ? 'text-white bg-[#00008f]' : 'text-gray-600 hover:bg-[#00008f] hover:text-white' }} rounded-lg transition-colors duration-200">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            Mon profil
        </a>
    </nav>

    <!-- User Info -->
    <div class="flex-shrink-0 border-t border-gray-200 bg-white">
        <div class="p-4">
            <div class="flex items-center bg-gray-50 rounded-lg p-3">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 rounded-full bg-[#00008f] text-white flex items-center justify-center text-lg font-semibold">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                </div>
                <div class="ml-3 min-w-0 flex-1">
                    <p class="text-sm font-medium text-gray-900 truncate">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-gray-500 truncate">{{ auth()->user()->email }}</p>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="ml-2">
                    @csrf
                    <button type="submit" class="p-2 text-gray-500 hover:text-[#00008f] rounded-lg transition-colors duration-200" title="Se déconnecter">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Mobile Navigation Toggle -->
<div class="fixed lg:hidden bottom-4 right-4 z-40">
    <button id="mobileMenuButton"
            class="bg-[#00008f] text-white p-3 rounded-full shadow-lg hover:bg-[#000066] transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#00008f]">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>
</div>

<!-- Overlay -->
<div id="sidenavOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-20 hidden lg:hidden"></div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuButton = document.getElementById('mobileMenuButton');
        const sidebar = document.querySelector('.fixed.inset-y-0');
        const overlay = document.getElementById('sidenavOverlay');
        let isOpen = false;

        function toggleMenu() {
            isOpen = !isOpen;
            if (isOpen) {
                sidebar.classList.remove('-translate-x-full');
                sidebar.classList.add('translate-x-0');
                overlay.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            } else {
                sidebar.classList.remove('translate-x-0');
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }
        }

        mobileMenuButton.addEventListener('click', toggleMenu);
        overlay.addEventListener('click', () => {
            if (isOpen) toggleMenu();
        });
    });
</script> 