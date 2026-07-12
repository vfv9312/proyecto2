<nav x-data="{ mobileMenuOpen: false }" class="fixed w-full z-50 top-0 transition-all duration-300 text-white" style="background-color: #556B2F; border-bottom: 1px solid #435522;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ session('guest_slug') ? route('invitation', session('guest_slug')) : route('home') }}" class="flex items-center gap-2">
                    <span class="text-2xl font-black text-white tracking-tighter font-serif italic">
                        Nuestra Boda
                    </span>
                </a>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-1">
                <a href="{{ route('gallery') }}" class="relative group px-4 py-2 text-sm font-bold text-white hover:text-gray-200 transition-colors overflow-hidden rounded-full">
                    <span class="relative z-10">Galería</span>
                    <span class="absolute inset-0 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-center rounded-full" style="background-color: #435522;"></span>
                </a>
            </div>


            <!-- Mobile Menu Button -->
            <div class="md:hidden flex items-center">
                <button type="button" @click="mobileMenuOpen = !mobileMenuOpen" class="text-white focus:outline-none focus:ring-2 focus:ring-white rounded-lg p-2 transition-colors hover:bg-opacity-20 hover:bg-black" aria-label="Toggle menu">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path x-show="mobileMenuOpen" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="mobileMenuOpen" x-transition x-cloak class="md:hidden" style="background-color: #556B2F; border-bottom: 1px solid #435522;">
        <div class="px-2 pt-2 pb-6 space-y-2 sm:px-3 text-center">
            <a href="{{ route('gallery') }}" class="block px-3 py-3 rounded-md text-base font-bold text-white transition hover:bg-opacity-20 hover:bg-black hover:text-gray-200">Galería</a>
        </div>
    </div>
</nav>
