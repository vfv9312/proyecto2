<section id="contact" class="py-20 bg-white dark:bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto text-center mb-16">
            <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white sm:text-4xl">
                Contáctanos
            </h2>
            <p class="mt-4 text-lg text-gray-500 dark:text-gray-400">
                ¿Tienes un proyecto en mente? Hablemos de cómo podemos ayudarte.
            </p>
        </div>

        <div class="max-w-2xl mx-auto bg-gray-50 dark:bg-gray-800 rounded-2xl p-8 shadow-sm border border-gray-200 dark:border-gray-700">
            <form action="#" method="POST" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nombre</label>
                        <input type="text" name="name" id="name" class="w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-gray-900 focus:border-gray-900 dark:focus:ring-white dark:focus:border-white transition-colors" placeholder="Tu nombre">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email</label>
                        <input type="email" name="email" id="email" class="w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-gray-900 focus:border-gray-900 dark:focus:ring-white dark:focus:border-white transition-colors" placeholder="correo@ejemplo.com">
                    </div>
                </div>
                
                <div>
                    <label for="subject" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Asunto</label>
                    <input type="text" name="subject" id="subject" class="w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-gray-900 focus:border-gray-900 dark:focus:ring-white dark:focus:border-white transition-colors" placeholder="¿En qué podemos ayudarte?">
                </div>

                <div>
                    <label for="message" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Mensaje</label>
                    <textarea name="message" id="message" rows="4" class="w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-gray-900 focus:border-gray-900 dark:focus:ring-white dark:focus:border-white transition-colors" placeholder="Cuéntanos sobre tu proyecto..."></textarea>
                </div>

                <div>
                    <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-gray-900 hover:bg-black dark:bg-white dark:text-black dark:hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 transition-all duration-200 transform hover:-translate-y-1">
                        Enviar Mensaje
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
