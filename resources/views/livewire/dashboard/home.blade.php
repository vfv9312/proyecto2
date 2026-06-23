<div>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Great+Vibes&family=Montserrat:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,600;1,400&display=swap');

        .font-script {
            font-family: 'Great Vibes', cursive;
        }

        .font-serif {
            font-family: 'Playfair Display', serif;
        }

        .font-sans {
            font-family: 'Montserrat', sans-serif;
        }

        .bg-ivory {
            background-color: #FFFFF0;
        }

        .bg-beige {
            background-color: #F5F5DC;
        }

        .text-olive {
            color: #556B2F;
        }

        .bg-olive {
            background-color: #556B2F;
        }

        .text-gold {
            color: #D4AF37;
        }

        .border-gold {
            border-color: #D4AF37;
        }

        .bg-wood {
            background-color: #D2B48C;
        }

        /* Floating Petals Animation */
        @keyframes fall {
            0% {
                opacity: 0;
                top: -10%;
                transform: translateX(0) rotate(0deg);
            }

            10% {
                opacity: 1;
            }

            20% {
                transform: translateX(-20px) rotate(45deg);
            }

            40% {
                transform: translateX(-40px) rotate(90deg);
            }

            60% {
                transform: translateX(20px) rotate(135deg);
            }

            80% {
                transform: translateX(-10px) rotate(180deg);
            }

            100% {
                top: 110%;
                transform: translateX(-30px) rotate(225deg);
                opacity: 0;
            }
        }

        .petal {
            position: absolute;
            width: 15px;
            height: 15px;
            background: #f7e1d7;
            border-radius: 15px 0 15px 0;
            opacity: 0;
            animation: fall 10s infinite linear;
            z-index: 10;
        }

        /* Animations */
        .fade-in-up {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 1s ease-out, transform 1s ease-out;
        }

        .fade-in-up.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .glow-btn {
            animation: glow 2s infinite alternate;
        }

        @keyframes glow {
            from {
                box-shadow: 0 0 10px -10px #D4AF37;
            }

            to {
                box-shadow: 0 0 20px 5px #D4AF37;
            }
        }

        /* Parallax Background */
        .parallax-bg {
            background-image: url('https://images.unsplash.com/photo-1519225421980-715cb0215aed?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>

    <div class="bg-ivory font-sans text-gray-800 overflow-x-hidden" x-data="{ musicPlaying: false, showEnvelope: false }">

        <!-- Audio -->
        <audio id="bg-music" loop>
            <source src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3" type="audio/mpeg">
        </audio>

        <!-- Floating Petals -->
        <div class="fixed inset-0 pointer-events-none overflow-hidden" aria-hidden="true">
            @for ($i = 0; $i < 15; $i++)
                <div class="petal"
                    style="left: {{ rand(5, 95) }}%; animation-delay: {{ rand(0, 10) }}s; animation-duration: {{ rand(8, 15) }}s;">
                </div>
            @endfor
        </div>

        <!-- 1. Pantalla de bienvenida -->
        <section class="relative h-screen flex items-center justify-center parallax-bg">
            <div class="absolute inset-0 bg-white/40"></div>
            <div class="relative z-10 text-center px-4" x-data="{ show: false }" x-init="setTimeout(() => show = true, 500)">
                <div class="transition-all duration-1000 transform"
                    :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">
                    <p class="text-olive font-sans tracking-widest uppercase text-sm md:text-base mb-4">Nuestra Boda</p>
                    <h1 class="font-script text-6xl md:text-8xl text-olive mb-4 drop-shadow-md">Yuri & Vladimir</h1>
                    <p class="font-serif text-xl md:text-2xl text-gray-700 italic mb-10">18 de Diciembre, 2026</p>

                    <button @click="document.getElementById('countdown').scrollIntoView({behavior: 'smooth'})"
                        class="bg-olive text-white px-8 py-3 rounded-full uppercase tracking-wider text-sm hover:bg-[#435522] transition shadow-lg inline-flex items-center space-x-2">
                        <span>Abrir Invitación</span>
                        <svg class="w-4 h-4 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                        </svg>
                    </button>

                    <!-- Music Toggle -->
                    <div class="mt-8">
                        <button
                            @click="musicPlaying ? document.getElementById('bg-music').pause() : document.getElementById('bg-music').play(); musicPlaying = !musicPlaying"
                            class="w-12 h-12 bg-white/80 rounded-full flex items-center justify-center mx-auto text-olive hover:bg-white transition shadow">
                            <svg x-show="!musicPlaying" class="w-6 h-6" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5 10v4a2 2 0 002 2h2l5 5V3l-5 5H7a2 2 0 00-2 2z">
                                </path>
                            </svg>
                            <svg x-show="musicPlaying" x-cloak class="w-6 h-6 animate-pulse" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- 2. Cuenta regresiva -->
        <section id="countdown" class="py-20 bg-beige" x-data="countdownData()" x-init="initTimer()">
            <div class="container mx-auto px-4 max-w-4xl text-center fade-in-up"
                x-intersect="$el.classList.add('visible')">
                <h2 class="font-serif text-3xl md:text-4xl text-olive mb-10 italic">Faltan</h2>
                <div class="flex justify-center gap-4 md:gap-10">
                    <div class="flex flex-col items-center">
                        <div
                            class="w-16 h-16 md:w-24 md:h-24 rounded-full border-2 border-gold flex items-center justify-center bg-white shadow-md">
                            <span class="text-2xl md:text-4xl font-serif text-olive" x-text="days"></span>
                        </div>
                        <span class="mt-2 text-xs md:text-sm uppercase tracking-widest text-gray-600">Días</span>
                    </div>
                    <div class="flex flex-col items-center">
                        <div
                            class="w-16 h-16 md:w-24 md:h-24 rounded-full border-2 border-gold flex items-center justify-center bg-white shadow-md">
                            <span class="text-2xl md:text-4xl font-serif text-olive" x-text="hours"></span>
                        </div>
                        <span class="mt-2 text-xs md:text-sm uppercase tracking-widest text-gray-600">Horas</span>
                    </div>
                    <div class="flex flex-col items-center">
                        <div
                            class="w-16 h-16 md:w-24 md:h-24 rounded-full border-2 border-gold flex items-center justify-center bg-white shadow-md">
                            <span class="text-2xl md:text-4xl font-serif text-olive" x-text="minutes"></span>
                        </div>
                        <span class="mt-2 text-xs md:text-sm uppercase tracking-widest text-gray-600">Minutos</span>
                    </div>
                    <div class="flex flex-col items-center">
                        <div
                            class="w-16 h-16 md:w-24 md:h-24 rounded-full border-2 border-gold flex items-center justify-center bg-white shadow-md">
                            <span class="text-2xl md:text-4xl font-serif text-olive" x-text="seconds"></span>
                        </div>
                        <span class="mt-2 text-xs md:text-sm uppercase tracking-widest text-gray-600">Segundos</span>
                    </div>
                </div>
            </div>
            <script>
                function countdownData() {
                    return {
                        days: '00',
                        hours: '00',
                        minutes: '00',
                        seconds: '00',
                        initTimer() {
                            const countDownDate = new Date("Nov 25, 2026 15:00:00").getTime();
                            setInterval(() => {
                                const now = new Date().getTime();
                                const distance = countDownDate - now;
                                if (distance < 0) return;
                                this.days = Math.floor(distance / (1000 * 60 * 60 * 24)).toString().padStart(2, '0');
                                this.hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)).toString()
                                    .padStart(2, '0');
                                this.minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60)).toString().padStart(
                                    2, '0');
                                this.seconds = Math.floor((distance % (1000 * 60)) / 1000).toString().padStart(2, '0');
                            }, 1000);
                        }
                    }
                }
            </script>
        </section>

        <!-- 3. Nuestra Historia -->
        <section class="py-20 bg-ivory">
            <div class="container mx-auto px-4 max-w-4xl text-center">
                <h2 class="font-script text-5xl text-olive mb-12">Nuestra Historia</h2>
                <div class="relative border-l-2 border-gold md:mx-auto md:w-1/2">

                    <div class="mb-10 ml-6 relative fade-in-up" x-intersect="$el.classList.add('visible')">
                        <div class="absolute w-4 h-4 bg-gold rounded-full -left-[1.95rem] top-2 shadow"></div>
                        <div class="bg-white p-6 rounded-lg shadow-md border border-beige text-left">
                            <span class="text-sm font-bold text-olive">Marzo 2020</span>
                            <h3 class="font-serif text-xl mb-2">Nos Conocimos</h3>
                            <p class="text-sm text-gray-600">Un encuentro casual en un café de la ciudad que cambió
                                nuestras vidas para siempre.</p>
                        </div>
                    </div>

                    <div class="mb-10 ml-6 relative fade-in-up" x-intersect="$el.classList.add('visible')">
                        <div class="absolute w-4 h-4 bg-gold rounded-full -left-[1.95rem] top-2 shadow"></div>
                        <div class="bg-white p-6 rounded-lg shadow-md border border-beige text-left">
                            <span class="text-sm font-bold text-olive">Diciembre 2022</span>
                            <h3 class="font-serif text-xl mb-2">Nuestro Primer Viaje</h3>
                            <p class="text-sm text-gray-600">Exploramos montañas y bosques, confirmando que nuestro amor
                                crecía con cada aventura.</p>
                        </div>
                    </div>

                    <div class="mb-10 ml-6 relative fade-in-up" x-intersect="$el.classList.add('visible')">
                        <div class="absolute w-4 h-4 bg-gold rounded-full -left-[1.95rem] top-2 shadow"></div>
                        <div class="bg-white p-6 rounded-lg shadow-md border border-beige text-left">
                            <span class="text-sm font-bold text-olive">Octubre 2025</span>
                            <h3 class="font-serif text-xl mb-2">El Compromiso</h3>
                            <p class="text-sm text-gray-600">Bajo un cielo estrellado y rodeados de naturaleza,
                                decidimos unir nuestros caminos.</p>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- 4. Información del evento -->
        <section class="py-20 bg-wood/20">
            <div class="container mx-auto px-4 max-w-5xl">
                <h2 class="font-serif text-3xl md:text-4xl text-olive text-center mb-12 italic">Detalles del Evento
                </h2>

                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Ceremonia -->
                    <div class="bg-white p-8 rounded-xl shadow-lg border-t-4 border-olive text-center fade-in-up"
                        x-intersect="$el.classList.add('visible')">
                        <svg class="w-12 h-12 mx-auto text-gold mb-4" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        <h3 class="font-serif text-2xl text-olive mb-2">Ceremonia Religiosa</h3>
                        <p class="font-bold text-gray-800 mb-1">Sábado 25 de Noviembre</p>
                        <p class="text-gray-600 mb-4">15:00 hrs</p>
                        <p class="text-sm text-gray-500 mb-6">Parroquia de San Miguel Arcángel<br>Calle Principal #123,
                            Centro.</p>
                        <a href="https://maps.google.com" target="_blank"
                            class="inline-block border border-olive text-olive px-6 py-2 rounded-full hover:bg-olive hover:text-white transition text-sm">Ver
                            en Mapa</a>
                    </div>

                    <!-- Recepción -->
                    <div class="bg-white p-8 rounded-xl shadow-lg border-t-4 border-olive text-center fade-in-up"
                        style="transition-delay: 200ms;" x-intersect="$el.classList.add('visible')">
                        <svg class="w-12 h-12 mx-auto text-gold mb-4" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2v10z"></path>
                        </svg>
                        <h3 class="font-serif text-2xl text-olive mb-2">Recepción</h3>
                        <p class="font-bold text-gray-800 mb-1">Sábado 25 de Noviembre</p>
                        <p class="text-gray-600 mb-4">17:00 hrs</p>
                        <p class="text-sm text-gray-500 mb-6">Jardín Los Encinos<br>Km 15 Carretera al Bosque.</p>
                        <a href="https://maps.google.com" target="_blank"
                            class="inline-block border border-olive text-olive px-6 py-2 rounded-full hover:bg-olive hover:text-white transition text-sm">Ver
                            en Mapa</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- 5. Distribución de mesas -->
        <section class="py-20 bg-ivory">
            <div class="container mx-auto px-4 max-w-xl text-center fade-in-up"
                x-intersect="$el.classList.add('visible')">
                <h2 class="font-script text-5xl text-olive mb-6">Tu Lugar</h2>
                <p class="text-gray-600 mb-8 text-sm">Ingresa tu nombre para buscar tu lugar asignado en nuestra boda.
                </p>

                <div class="bg-white p-8 rounded-2xl shadow-xl border border-beige relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-olive to-gold"></div>

                    <!-- Search input (Simulated) -->
                    <div class="mb-6">
                        <input type="text" placeholder="Tu nombre completo..."
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-olive focus:ring-1 focus:ring-olive transition">
                    </div>

                    <!-- Placeholder Results -->
                    <div class="p-6 bg-beige/30 rounded-xl border border-gold/30">
                        <h4 class="font-serif text-xl text-olive mb-4">¡Te esperamos, Invitado!</h4>
                        <div class="grid grid-cols-2 gap-4 text-left">
                            <div class="bg-white p-3 rounded shadow-sm border-l-4 border-olive">
                                <span class="block text-xs text-gray-500 uppercase">Mesa</span>
                                <span class="font-bold text-lg text-gray-800">Mesa 5</span>
                                <span class="block text-xs text-gray-400 italic">"Los Pinos"</span>
                            </div>
                            <div class="bg-white p-3 rounded shadow-sm border-l-4 border-gold">
                                <span class="block text-xs text-gray-500 uppercase">Asientos</span>
                                <span class="font-bold text-lg text-gray-800">2</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 6. Video personalizado -->
        <section class="py-20 bg-olive text-white relative">
            <!-- Decorative overlay -->
            <div class="absolute inset-0 opacity-10"
                style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');">
            </div>

            <div class="container mx-auto px-4 max-w-4xl text-center relative z-10 fade-in-up"
                x-intersect="$el.classList.add('visible')">
                <h2 class="font-serif text-3xl md:text-4xl text-gold mb-4 italic">Un Mensaje para Ti</h2>
                <p class="font-sans font-light mb-10 opacity-90">Queremos compartir nuestra felicidad contigo.</p>

                <div
                    class="relative p-2 md:p-4 bg-wood/40 rounded-2xl shadow-2xl backdrop-blur-sm border border-gold/30 inline-block w-full">
                    <div
                        class="aspect-w-16 aspect-h-9 w-full bg-black rounded-xl overflow-hidden relative shadow-inner">
                        <!-- Placeholder video via iframe or video tag -->
                        <div
                            class="absolute inset-0 flex items-center justify-center bg-gray-900 group cursor-pointer hover:bg-gray-800 transition">
                            <svg class="w-16 h-16 text-white/70 group-hover:text-gold transition transform group-hover:scale-110"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 7. Confirmación de asistencia -->
        <section class="py-20 bg-beige relative overflow-hidden">
            <div class="container mx-auto px-4 max-w-2xl fade-in-up" x-intersect="$el.classList.add('visible')">
                <div class="bg-white p-10 rounded-3xl shadow-xl relative z-10">
                    <div class="text-center mb-8">
                        <h2 class="font-script text-5xl text-olive mb-2">Asistencia</h2>
                        <p class="text-gray-600 text-sm">Por favor confirma tu asistencia antes del 1 de Noviembre.</p>
                    </div>

                    <form class="space-y-6" wire:submit.prevent="submit">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nombre Completo</label>
                            <input type="text"
                                class="w-full border-b-2 border-gray-300 px-3 py-2 focus:outline-none focus:border-olive transition bg-transparent"
                                placeholder="Ej. Juan Pérez">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Número de Asistentes</label>
                            <select
                                class="w-full border-b-2 border-gray-300 px-3 py-2 focus:outline-none focus:border-olive transition bg-transparent">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">¿Asistirás?</label>
                            <div class="flex gap-4">
                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <input type="radio" name="attending"
                                        class="text-olive focus:ring-olive w-4 h-4">
                                    <span class="text-gray-700">Sí, ahí estaré</span>
                                </label>
                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <input type="radio" name="attending"
                                        class="text-olive focus:ring-olive w-4 h-4">
                                    <span class="text-gray-700">No podré asistir</span>
                                </label>
                            </div>
                        </div>
                        <div class="pt-4 text-center">
                            <button type="submit"
                                class="bg-olive text-white px-10 py-3 rounded-full hover:bg-[#435522] transition shadow-lg uppercase tracking-wide text-sm">Confirmar</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <!-- 8. Mesa de regalos -->
        <section class="py-20 bg-ivory">
            <div class="container mx-auto px-4 max-w-3xl text-center fade-in-up"
                x-intersect="$el.classList.add('visible')">
                <svg class="w-16 h-16 mx-auto text-gold mb-6" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7">
                    </path>
                </svg>
                <h2 class="font-serif text-3xl md:text-4xl text-olive mb-6 italic">Mesa de Regalos</h2>

                <p class="text-gray-600 mb-8 leading-relaxed max-w-xl mx-auto">
                    El mejor regalo es tu presencia. Pero si deseas tener un detalle con nosotros, agradeceríamos mucho
                    recibir tu regalo en efectivo para ayudarnos a comenzar esta nueva etapa juntos.
                </p>

                <button @click="showEnvelope = !showEnvelope"
                    class="border-2 border-gold text-olive px-8 py-3 rounded-full hover:bg-gold hover:text-white transition inline-flex items-center space-x-2 font-medium">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                        </path>
                    </svg>
                    <span>Ver Datos Bancarios</span>
                </button>

                <div x-show="showEnvelope" x-collapse x-cloak class="mt-8">
                    <div
                        class="bg-white p-8 rounded-xl shadow-md border border-beige max-w-md mx-auto relative transform transition-all">
                        <div
                            class="absolute -top-3 left-1/2 transform -translate-x-1/2 w-6 h-6 bg-white border-l border-t border-beige rotate-45">
                        </div>
                        <h4 class="font-bold text-gray-800 mb-4">Transferencia Bancaria</h4>
                        <p class="text-sm text-gray-600 mb-2">Banco: <span
                                class="font-semibold text-gray-800">BBVA</span></p>
                        <p class="text-sm text-gray-600 mb-2">Titular: <span
                                class="font-semibold text-gray-800">Carlos y Ana</span></p>
                        <p class="text-sm text-gray-600 mb-4">CLABE: <span class="font-semibold text-gray-800">0123
                                4567 8901 2345 67</span></p>
                        <p class="text-xs text-gray-400 italic">¡Muchas gracias por tu cariño!</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- 9. Galería -->
        <section class="py-20 bg-wood/10" x-data="{ imgModal: false, imgModalSrc: '' }">
            <div class="container mx-auto px-4">
                <h2 class="font-script text-5xl text-olive mb-12 text-center">Nuestros Momentos</h2>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <!-- Gallery Items -->
                    @for ($i = 1; $i <= 8; $i++)
                        <div class="aspect-w-1 aspect-h-1 overflow-hidden rounded-lg shadow-sm cursor-pointer group fade-in-up"
                            style="transition-delay: {{ $i * 100 }}ms" x-intersect="$el.classList.add('visible')"
                            @click="imgModalSrc = 'https://source.unsplash.com/random/800x800/?wedding,couple,nature&sig={{ $i }}'; imgModal = true">
                            <img src="https://source.unsplash.com/random/400x400/?wedding,couple,nature&sig={{ $i }}"
                                alt="Galeria {{ $i }}"
                                class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500">
                            <div
                                class="absolute inset-0 bg-olive/20 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>

            <!-- Lightbox Modal -->
            <div x-show="imgModal" x-cloak
                class="fixed inset-0 z-50 flex items-center justify-center bg-black/90 p-4 backdrop-blur-sm"
                x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                <button @click="imgModal = false"
                    class="absolute top-6 right-6 text-white hover:text-gold transition">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
                <img :src="imgModalSrc" class="max-w-full max-h-[90vh] object-contain rounded shadow-2xl"
                    @click.away="imgModal = false">
            </div>
        </section>

        <!-- 10. Mensaje final -->
        <section class="py-32 bg-olive text-center text-white relative overflow-hidden">
            <!-- Decorative corner leaves -->
            <svg class="absolute top-0 left-0 w-32 h-32 text-gold/20 transform -translate-x-1/2 -translate-y-1/2"
                fill="currentColor" viewBox="0 0 100 100">
                <path
                    d="M50 0C50 27.6 27.6 50 0 50C27.6 50 50 72.4 50 100C50 72.4 72.4 50 100 50C72.4 50 50 27.6 50 0Z" />
            </svg>
            <svg class="absolute bottom-0 right-0 w-32 h-32 text-gold/20 transform translate-x-1/2 translate-y-1/2"
                fill="currentColor" viewBox="0 0 100 100">
                <path
                    d="M50 0C50 27.6 27.6 50 0 50C27.6 50 50 72.4 50 100C50 72.4 72.4 50 100 50C72.4 50 50 27.6 50 0Z" />
            </svg>

            <div class="container mx-auto px-4 relative z-10 fade-in-up" x-intersect="$el.classList.add('visible')">
                <h2 class="font-script text-5xl md:text-6xl mb-6">Gracias</h2>
                <p class="font-serif text-xl md:text-2xl mb-12 max-w-2xl mx-auto italic font-light">"El amor no se mira
                    con los ojos, sino con el corazón."</p>
                <button
                    class="bg-gold text-olive px-10 py-4 rounded-full font-bold uppercase tracking-widest text-sm hover:bg-white transition glow-btn inline-block">
                    Nos vemos en nuestra boda
                </button>
            </div>
        </section>

    </div>
</div>
