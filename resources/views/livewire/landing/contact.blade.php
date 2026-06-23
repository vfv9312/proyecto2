<section id="contact" class="py-20 bg-white dark:bg-gray-900 overflow-hidden relative">
    <!-- Decorative background elements -->
    <div class="absolute top-0 right-0 -mr-20 -mt-20 w-80 h-80 rounded-full bg-gray-100 dark:bg-gray-800 opacity-50 blur-3xl animate-float"></div>
    <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-60 h-60 rounded-full bg-gray-200 dark:bg-gray-700 opacity-30 blur-2xl animate-float delay-500"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-3xl mx-auto text-center mb-16 animate-on-scroll">
            <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white sm:text-4xl bg-clip-text text-transparent bg-gradient-to-r from-gray-900 to-gray-600 dark:from-white dark:to-gray-400">
                Contáctanos
            </h2>
            <p class="mt-4 text-lg text-gray-500 dark:text-gray-400">
                ¿Tienes un proyecto en mente? Hablemos de cómo podemos ayudarte.
            </p>
        </div>

        <div class="max-w-2xl mx-auto">
            <div class="bg-gray-50 dark:bg-gray-800/80 backdrop-blur-sm rounded-2xl p-8 shadow-xl border border-gray-200 dark:border-gray-700 animate-on-scroll delay-200 transition-all duration-500 hover:shadow-2xl">
                
                @if($success)
                    <div class="mb-8 p-4 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 rounded-lg flex items-center gap-3 animate-fade-in-up">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-green-600 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-green-800 dark:text-green-300">Mensaje enviado correctamente</h3>
                            <p class="mt-1 text-sm text-green-700 dark:text-green-400">Nos pondremos en contacto contigo a la brevedad.</p>
                        </div>
                    </div>
                @endif

                <form wire:submit.prevent="submit" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="group">
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 transition-colors group-hover:text-gray-900 dark:group-hover:text-white">Nombre</label>
                            <input type="text" wire:model="name" id="name" class="w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-gray-900 focus:border-gray-900 dark:focus:ring-white dark:focus:border-white transition-all duration-300 shadow-sm focus:shadow-md @error('name') border-red-500 @enderror" placeholder="Tu nombre">
                            @error('name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div class="group">
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 transition-colors group-hover:text-gray-900 dark:group-hover:text-white">Email</label>
                            <input type="email" wire:model="email" id="email" class="w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-gray-900 focus:border-gray-900 dark:focus:ring-white dark:focus:border-white transition-all duration-300 shadow-sm focus:shadow-md @error('email') border-red-500 @enderror" placeholder="correo@ejemplo.com">
                            @error('email') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    
                    <div class="group">
                        <label for="subject" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 transition-colors group-hover:text-gray-900 dark:group-hover:text-white">Asunto</label>
                        <input type="text" wire:model="subject" id="subject" class="w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-gray-900 focus:border-gray-900 dark:focus:ring-white dark:focus:border-white transition-all duration-300 shadow-sm focus:shadow-md @error('subject') border-red-500 @enderror" placeholder="¿En qué podemos ayudarte?">
                        @error('subject') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="group">
                        <label for="message" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 transition-colors group-hover:text-gray-900 dark:group-hover:text-white">Mensaje</label>
                        <textarea wire:model="message" id="message" rows="4" class="w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-gray-900 focus:border-gray-900 dark:focus:ring-white dark:focus:border-white transition-all duration-300 shadow-sm focus:shadow-md @error('message') border-red-500 @enderror" placeholder="Cuéntanos sobre tu proyecto..."></textarea>
                        @error('message') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <button type="submit" wire:loading.attr="disabled" class="w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-lg shadow-md text-sm font-bold text-white bg-gray-900 hover:bg-black dark:bg-white dark:text-black dark:hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg disabled:opacity-50 disabled:cursor-not-allowed">
                            <span wire:loading.remove>Enviar Mensaje</span>
                            <span wire:loading>
                                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white dark:text-black" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Enviando...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
