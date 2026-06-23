<div class="flex items-center justify-center w-full h-screen dark:bg-gray-950">
    <div class="flex w-full text-slate-800">
        <div class="relative flex-col justify-center hidden object-center h-screen text-center md:flex md:w-1/2">
            <img class="object-cover w-full h-full" src="https://picsum.photos/1920/1080?grayscale&blur=2" />
            <div class="absolute inset-0 bg-black/20"></div>
        </div>
        <div class="flex flex-col justify-center items-center w-full md:w-1/2 h-screen bg-white dark:bg-gray-900 transition-colors duration-300">
            <div class="w-full max-w-md px-8 py-10 bg-white dark:bg-gray-900 md:bg-transparent md:dark:bg-transparent animate-fade-in-up">
                
                <div class="mb-10 text-center animate-fade-in-up" style="animation-delay: 100ms; animation-fill-mode: backwards;">
                    <span class="inline-block p-3 rounded-2xl bg-gray-100 dark:bg-gray-800 mb-6 shadow-inner animate-float">
                        <svg class="w-8 h-8 text-gray-900 dark:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                        </svg>
                    </span>
                    <h2 class="text-4xl font-black text-gray-900 dark:text-white tracking-tight mb-3">
                        Recuperar Contraseña
                    </h2>
                    <p class="text-gray-500 dark:text-gray-400 text-lg">
                        Ingresa tu correo electrónico y te enviaremos las instrucciones.
                    </p>
                </div>

                <form wire:submit.prevent="store" class="space-y-6 animate-fade-in-up" style="animation-delay: 200ms; animation-fill-mode: backwards;">
                    <div class="animate-fade-in-up" style="animation-delay: 300ms; animation-fill-mode: backwards;">
                        <label for="email" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2 ml-1">
                            Correo electrónico
                        </label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400 group-focus-within:text-gray-900 dark:group-focus-within:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                </svg>
                            </div>
                            <input type="email" id="email" wire:model="email" 
                                class="w-full pl-11 pr-4 py-3.5 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 dark:focus:ring-white focus:border-transparent transition-all duration-300 shadow-sm group-hover:bg-white dark:group-hover:bg-gray-750" 
                                placeholder="nombre@empresa.com" required>
                        </div>
                        @error('email') <span class="text-red-500 text-xs mt-1 ml-1 block font-medium">{{ $message }}</span> @enderror
                    </div>

                    <div class="pt-4 animate-fade-in-up" style="animation-delay: 400ms; animation-fill-mode: backwards;">
                        <button type="submit" wire:loading.attr="disabled"
                            class="w-full flex justify-center py-4 px-4 border border-transparent rounded-xl shadow-lg text-sm font-bold text-white bg-gray-900 hover:bg-black dark:bg-white dark:text-black dark:hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 dark:focus:ring-white transition-all duration-300 transform hover:-translate-y-1 hover:shadow-xl disabled:opacity-50 disabled:cursor-not-allowed">
                            Enviar Instrucciones
                        </button>
                    </div>

                    <div class="text-center animate-fade-in-up" style="animation-delay: 500ms; animation-fill-mode: backwards;">
                        <a href="{{ route('login') }}" class="inline-flex items-center text-sm font-semibold text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors group">
                            <svg class="w-4 h-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Volver al inicio de sesión
                        </a>
                    </div>
                </form>

                <p class="mt-8 text-center text-sm text-gray-500 dark:text-gray-400 animate-fade-in-up" style="animation-delay: 600ms; animation-fill-mode: backwards;">
                    &copy; {{ date('Y') }} CYBAC. Todos los derechos reservados.
                </p>
            </div>
        </div>
    </div>
    <!-- Loading Overlay -->
    <div wire:loading.flex wire:target="store" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900/50 backdrop-blur-sm transition-opacity">
        <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-2xl flex flex-col items-center animate-bounce-small transform scale-100 transition-transform duration-300">
            <svg class="animate-spin h-12 w-12 text-gray-900 dark:text-white mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <p class="text-base font-bold text-gray-900 dark:text-white tracking-wide">Procesando solicitud...</p>
        </div>
    </div>
</div>
