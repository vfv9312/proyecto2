    <div class="bg-gray-50 dark:bg-gray-900 min-h-screen transition-colors duration-300">
        <!-- Navbar -->
        <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700 transition-colors duration-300">
            <div class="px-4 py-3">
                <div class="flex items-center justify-between">
                    <!-- Left: Hamburger + Logo -->
                    <div class="flex items-center gap-3">
                        <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button"
                            class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none dark:text-gray-400 dark:hover:bg-gray-700">
                            <span class="sr-only">Open sidebar</span>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 5A.75.75 0 012.75 9h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 9.75zm0 5A.75.75 0 012.75 14h14.5a.75.75 0 010 1.5H2.75a.75.75 0 01-.75-.75z"/>
                            </svg>
                        </button>
                        <a href="{{ route('dashboard') }}" class="flex items-center gap-2 group">
                            <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-gray-800 to-black dark:from-white dark:to-gray-200 flex items-center justify-center shadow-lg group-hover:scale-105 transition-transform duration-300">
                                <span class="text-white dark:text-black font-black text-lg leading-none">C</span>
                            </div>
                            <span class="text-xl font-bold whitespace-nowrap dark:text-white tracking-tight hidden sm:block">CYBAC</span>
                        </a>
                    </div>

                    <!-- Right: Theme Toggle + User Menu -->
                    <div class="flex items-center gap-2">
                        <!-- Theme Toggle -->
                        <button id="theme-toggle" type="button"
                            class="p-2 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-all duration-300 hover:rotate-12">
                            <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"/>
                            </svg>
                            <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 100 2h1z" fill-rule="evenodd" clip-rule="evenodd"/>
                            </svg>
                        </button>

                        <!-- User Dropdown — Alpine.js (no Flowbite conflict) -->
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" @keydown.escape="open = false" type="button"
                                class="flex items-center gap-2 p-1 rounded-full hover:ring-2 hover:ring-gray-300 dark:hover:ring-gray-600 transition-all duration-200 focus:outline-none">
                                <div class="w-8 h-8 rounded-full bg-gray-900 dark:bg-white flex items-center justify-center text-white dark:text-black font-bold text-sm overflow-hidden flex-shrink-0">
                                    @if(Auth::user()->profile_photo_url ?? false)
                                        <img class="w-8 h-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="avatar">
                                    @else
                                        {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                                    @endif
                                </div>
                                <span class="hidden sm:block text-sm font-semibold text-gray-700 dark:text-gray-200 max-w-[120px] truncate">
                                    {{ Auth::user()->name }}
                                </span>
                                <svg class="w-4 h-4 text-gray-400 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>

                            <!-- Dropdown Panel -->
                            <div x-show="open"
                                @click.outside="open = false"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 scale-95 translate-y-1"
                                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                                x-transition:leave-end="opacity-0 scale-95 translate-y-1"
                                class="absolute right-0 top-full mt-2 w-64 bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 z-50 overflow-hidden"
                                style="display: none;">

                                <!-- User Info Header -->
                                <div class="px-4 py-4 bg-gray-50 dark:bg-gray-700/50 border-b border-gray-100 dark:border-gray-700">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-gray-900 dark:bg-white flex items-center justify-center text-white dark:text-black font-bold text-sm flex-shrink-0">
                                            {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                                        </div>
                                        <div class="min-w-0">
                                            <p class="text-sm font-bold text-gray-900 dark:text-white truncate">{{ Auth::user()->name }}</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ Auth::user()->email }}</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Menu Items -->
                                <ul class="py-2">
                                    <li>
                                        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                                            Dashboard
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                            Mi Perfil
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                            Configuración
                                        </a>
                                    </li>
                                </ul>

                                <!-- Logout -->
                                <div class="border-t border-gray-100 dark:border-gray-700 py-2">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="flex items-center gap-3 w-full px-4 py-2.5 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                            Cerrar sesión
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Sidebar -->
        <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-16 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
            <div class="h-full px-3 py-4 overflow-y-auto bg-white dark:bg-gray-800">
                <ul class="space-y-1 font-medium">
                    <li>
                        <a href="{{ route('dashboard') }}" class="flex items-center p-3 text-gray-900 rounded-xl dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group transition-all duration-300 {{ request()->routeIs('dashboard') ? 'bg-gray-100 dark:bg-gray-700 font-bold' : '' }}">
                            <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white group-hover:scale-110" fill="currentColor" viewBox="0 0 22 21">
                                <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                                <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
                            </svg>
                            <span class="ml-3 group-hover:tracking-wide transition-all duration-300">Dashboard</span>
                        </a>
                    </li>

                    <li class="pt-4 pb-1">
                        <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-3">Módulos</span>
                    </li>

                    <li>
                        <a href="#" class="flex items-center p-3 text-gray-900 rounded-xl dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group transition-all duration-300">
                            <svg class="flex-shrink-0 w-5 h-5 text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white group-hover:scale-110 transition-all" fill="currentColor" viewBox="0 0 18 18">
                                <path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z"/>
                            </svg>
                            <span class="flex-1 ml-3 whitespace-nowrap group-hover:tracking-wide transition-all duration-300">Kanban</span>
                            <span class="inline-flex items-center justify-center px-2 text-xs font-semibold text-gray-600 bg-gray-100 rounded-full dark:bg-gray-700 dark:text-gray-300 border border-gray-200 dark:border-gray-600">Pro</span>
                        </a>
                    </li>

                    <li>
                        <button type="button" class="flex items-center w-full p-3 text-gray-900 rounded-xl dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group transition-all duration-300" aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                            <svg class="flex-shrink-0 w-5 h-5 text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white group-hover:scale-110 transition-all" fill="currentColor" viewBox="0 0 20 18">
                                <path d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z"/>
                            </svg>
                            <span class="flex-1 ml-3 text-left whitespace-nowrap group-hover:tracking-wide transition-all duration-300">Usuarios</span>
                            <svg class="w-3 h-3 text-gray-400 transition-transform duration-300" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                            </svg>
                        </button>
                        <ul id="dropdown-example" class="hidden py-1 space-y-1 ml-4 pl-3 border-l-2 border-gray-100 dark:border-gray-700">
                            <li>
                                <a href="{{ route('users.index') }}" class="flex items-center gap-2 p-2 text-sm text-gray-700 rounded-lg dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 group transition-colors">
                                    <div class="w-1.5 h-1.5 rounded-full bg-gray-300 group-hover:bg-gray-900 dark:group-hover:bg-white transition-colors"></div>
                                    Lista de Usuarios
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="pt-4 pb-1">
                        <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-3">🌿 Boda</span>
                    </li>

                    <li>
                        <a href="{{ route('admin.guests') }}" class="flex items-center p-3 text-gray-900 rounded-xl dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group transition-all duration-300 {{ request()->routeIs('admin.guests') ? 'bg-green-50 dark:bg-green-900/30 font-bold text-green-700 dark:text-green-400' : '' }}">
                            <svg class="flex-shrink-0 w-5 h-5 text-gray-500 dark:text-gray-400 group-hover:text-green-700 group-hover:scale-110 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span class="flex-1 ml-3 whitespace-nowrap group-hover:tracking-wide transition-all duration-300">Invitados</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.confirmations') }}" class="flex items-center p-3 text-gray-900 rounded-xl dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group transition-all duration-300 {{ request()->routeIs('admin.confirmations') ? 'bg-green-50 dark:bg-green-900/30 font-bold text-green-700 dark:text-green-400' : '' }}">
                            <svg class="flex-shrink-0 w-5 h-5 text-gray-500 dark:text-gray-400 group-hover:text-green-700 group-hover:scale-110 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                            </svg>
                            <span class="flex-1 ml-3 whitespace-nowrap group-hover:tracking-wide transition-all duration-300">Confirmaciones</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.settings') }}" class="flex items-center p-3 text-gray-900 rounded-xl dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group transition-all duration-300 {{ request()->routeIs('admin.settings') ? 'bg-green-50 dark:bg-green-900/30 font-bold text-green-700 dark:text-green-400' : '' }}">
                            <svg class="flex-shrink-0 w-5 h-5 text-gray-500 dark:text-gray-400 group-hover:text-green-700 group-hover:scale-110 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span class="flex-1 ml-3 whitespace-nowrap group-hover:tracking-wide transition-all duration-300">Configuración Boda</span>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>

        <main class="h-auto p-4 pt-20 overflow-x-auto sm:ml-64">
            @include('partials.alerts')
            @yield('content')
        </main>
    </div>
