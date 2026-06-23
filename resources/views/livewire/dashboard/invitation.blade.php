<div>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Great+Vibes&family=Montserrat:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,600;1,400&display=swap');
        .font-script { font-family: 'Great Vibes', cursive; }
        .font-serif  { font-family: 'Playfair Display', serif; }
        .font-sans   { font-family: 'Montserrat', sans-serif; }

        .bg-ivory  { background-color: #FFFFF0; }
        .bg-beige  { background-color: #F5F5DC; }
        .text-olive { color: #556B2F; }
        .bg-olive   { background-color: #556B2F; }
        .text-gold  { color: #D4AF37; }
        .border-gold { border-color: #D4AF37; }
        .bg-wood    { background-color: #D2B48C; }

        /* Floating Petals */
        @keyframes fall {
            0%   { opacity: 0; top: -10%; transform: translateX(0) rotate(0deg); }
            10%  { opacity: 1; }
            50%  { transform: translateX(-30px) rotate(90deg); }
            100% { top: 110%; transform: translateX(20px) rotate(225deg); opacity: 0; }
        }
        .petal {
            position: absolute;
            width: 15px; height: 15px;
            background: #f7e1d7;
            border-radius: 15px 0 15px 0;
            opacity: 0;
            animation: fall 10s infinite linear;
        }

        /* Fade in */
        .fade-in-up { opacity: 0; transform: translateY(30px); transition: opacity 1s ease-out, transform 1s ease-out; }
        .fade-in-up.visible { opacity: 1; transform: translateY(0); }

        /* Glow button */
        @keyframes glow {
            from { box-shadow: 0 0 10px -10px #D4AF37; }
            to   { box-shadow: 0 0 20px 5px #D4AF37; }
        }
        .glow-btn { animation: glow 2s infinite alternate; }

        /* Parallax hero */
        .parallax-bg {
            background-image: url('{{ $settings["hero_image_url"] ?? "https://images.unsplash.com/photo-1519225421980-715cb0215aed?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80" }}');
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        /* Countdown */
        @keyframes countPulse {
            0%,100% { transform: scale(1); }
            50%      { transform: scale(1.05); }
        }
        .count-digit { animation: countPulse 2s ease-in-out infinite; }

        /* Envelope */
        @keyframes envelopeOpen {
            0%   { transform: rotateX(0deg); }
            100% { transform: rotateX(-180deg); }
        }
    </style>

    <div class="bg-ivory font-sans text-gray-800 overflow-x-hidden" x-data="invitacion()" x-init="init()">

        <!-- Audio -->
        <audio id="bg-music" loop>
            <source src="{{ $settings['music_url'] ?? 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3' }}" type="audio/mpeg">
        </audio>

        <!-- Floating Petals -->
        <div class="fixed inset-0 pointer-events-none overflow-hidden z-0" aria-hidden="true">
            @for ($i = 0; $i < 15; $i++)
                <div class="petal" style="left: {{ rand(5, 95) }}%; animation-delay: {{ rand(0, 10) }}s; animation-duration: {{ rand(8, 15) }}s;"></div>
            @endfor
        </div>

        {{-- 1. HERO --}}
        <section class="relative h-screen flex items-center justify-center parallax-bg">
            <div class="absolute inset-0 bg-white/40"></div>
            <div class="relative z-10 text-center px-4" x-data="{ show: false }" x-init="setTimeout(() => show = true, 500)">
                <div :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'" class="transition-all duration-1000 transform">
                    <p class="text-olive font-sans tracking-widest uppercase text-sm md:text-base mb-4">
                        ¡Hola, <span class="font-semibold">{{ $guest->name }}</span>!
                    </p>
                    <p class="font-serif text-lg md:text-xl text-gray-600 italic mb-3">Tienes una invitación especial</p>
                    <h1 class="font-script text-6xl md:text-8xl text-olive mb-4 drop-shadow-md">
                        {{ $settings['bride_name'] ?? 'Yuri' }} &amp; {{ $settings['groom_name'] ?? 'Vladimir' }}
                    </h1>
                    <p class="font-serif text-xl md:text-2xl text-gray-700 italic mb-10">
                        {{ $settings['wedding_date_text'] ?? '18 de Diciembre, 2026' }}
                    </p>

                    <button @click="document.getElementById('countdown').scrollIntoView({behavior: 'smooth'}); playMusic()"
                        class="bg-olive text-white px-8 py-3 rounded-full uppercase tracking-wider text-sm hover:bg-[#435522] transition shadow-lg inline-flex items-center space-x-2 glow-btn">
                        <span>Abrir Invitación</span>
                        <svg class="w-4 h-4 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                        </svg>
                    </button>

                    <!-- Music Toggle -->
                    <div class="mt-8">
                        <button @click="toggleMusic()"
                            class="w-12 h-12 bg-white/80 rounded-full flex items-center justify-center mx-auto text-olive hover:bg-white transition shadow">
                            <svg x-show="!musicPlaying" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.383 3.076A1 1 0 0110 4v12a1 1 0 01-1.617.784L4.93 14H3a1 1 0 01-1-1V7a1 1 0 011-1h1.93l3.453-2.784a1 1 0 011 .076zM12.293 7.293a1 1 0 011.414 0A4.992 4.992 0 0115 10a4.992 4.992 0 01-1.293 2.707 1 1 0 01-1.414-1.414A2.992 2.992 0 0013 10a2.992 2.992 0 00-.707-1.293 1 1 0 010-1.414z"/><path d="M14.657 4.343a1 1 0 011.414 0A8.987 8.987 0 0118 10a8.987 8.987 0 01-1.929 5.657 1 1 0 01-1.414-1.414A6.987 6.987 0 0016 10a6.987 6.987 0 00-1.343-4.243 1 1 0 010-1.414z"/></svg>
                            <svg x-show="musicPlaying" x-cloak class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zM7 8a1 1 0 012 0v4a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v4a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                        </button>
                        <p class="text-xs text-gray-500 mt-2" x-text="musicPlaying ? 'Pausar música' : 'Reproducir música'"></p>
                    </div>
                </div>
            </div>
        </section>

        {{-- 2. CUENTA REGRESIVA --}}
        <section id="countdown" class="py-20 bg-olive text-white">
            <div class="container mx-auto px-4 max-w-4xl text-center">
                <p class="font-sans tracking-widest uppercase text-sm mb-4 opacity-70">Faltan...</p>
                <h2 class="font-serif text-3xl md:text-4xl italic mb-12 text-gold">Para el gran día</h2>
                <div class="grid grid-cols-4 gap-2 sm:gap-4 max-w-lg mx-auto">
                    <template x-for="(unit, label) in { días: days, horas: hours, minutos: minutes, segundos: seconds }">
                        <div class="bg-white/10 rounded-xl sm:rounded-2xl p-2 sm:p-4 backdrop-blur-sm border border-white/20 flex flex-col justify-center items-center">
                            <div class="count-digit text-2xl sm:text-4xl md:text-5xl font-black text-gold leading-none" x-text="unit"></div>
                            <div class="text-[10px] sm:text-xs uppercase tracking-normal sm:tracking-widest mt-1.5 opacity-70 w-full text-center truncate" x-text="label"></div>
                        </div>
                    </template>
                </div>
            </div>
        </section>

        {{-- 3. NUESTRA HISTORIA --}}
        <section class="py-20 bg-ivory">
            <div class="container mx-auto px-4 max-w-4xl">
                <h2 class="font-script text-5xl md:text-6xl text-olive text-center mb-16 fade-in-up" x-intersect="$el.classList.add('visible')">Nuestra Historia</h2>
                <div class="relative">
                    <div class="absolute left-1/2 top-0 bottom-0 w-px bg-olive/20 hidden md:block"></div>
                    @php
                    $stories = [
                        ['year' => '2019', 'title' => 'El Primer Encuentro', 'text' => 'En una tarde otoñal, nuestros caminos se cruzaron por primera vez. Una sonrisa fue suficiente para saber que algo especial comenzaba.', 'delay' => '0'],
                        ['year' => '2021', 'title' => 'La Aventura Juntos', 'text' => 'Viajes, risas, desafíos y aprendizajes. Cada momento nos fue enseñando que somos el equipo perfecto el uno para el otro.', 'delay' => '100'],
                        ['year' => '2026', 'title' => 'El Gran Sí', 'text' => 'Bajo un cielo estrellado y rodeados de naturaleza, decidimos unir nuestros caminos para siempre.', 'delay' => '200'],
                    ];
                    @endphp
                    @foreach($stories as $i => $s)
                    <div class="flex flex-col {{ $i % 2 == 0 ? 'md:flex-row' : 'md:flex-row-reverse' }} gap-8 mb-16 fade-in-up" style="transition-delay: {{ $s['delay'] }}ms" x-intersect="$el.classList.add('visible')">
                        <div class="md:w-1/2 flex {{ $i % 2 == 0 ? 'md:justify-end' : 'md:justify-start' }}">
                            <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100 max-w-sm">
                                <span class="font-script text-5xl text-gold">{{ $s['year'] }}</span>
                                <h3 class="font-serif text-xl text-olive mt-2 mb-3">{{ $s['title'] }}</h3>
                                <p class="text-sm text-gray-600 leading-relaxed">{{ $s['text'] }}</p>
                            </div>
                        </div>
                        <div class="hidden md:flex items-center justify-center md:w-0">
                            <div class="w-4 h-4 rounded-full bg-olive ring-4 ring-olive/20 absolute"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- 4. DETALLES DEL EVENTO --}}
        <section class="py-20 bg-wood/20">
            <div class="container mx-auto px-4 max-w-5xl">
                <h2 class="font-serif text-3xl md:text-4xl text-olive text-center mb-12 italic fade-in-up" x-intersect="$el.classList.add('visible')">Detalles del Evento</h2>
                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Ceremonia -->
                    <div class="bg-white p-8 rounded-xl shadow-lg border-t-4 border-olive text-center fade-in-up" x-intersect="$el.classList.add('visible')">
                        <svg class="w-12 h-12 mx-auto text-gold mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                        <h3 class="font-serif text-2xl text-olive mb-2">Ceremonia</h3>
                        <p class="font-bold text-gray-800 mb-1">{{ $settings['wedding_date_text'] ?? '' }}</p>
                        <p class="text-gray-600 mb-4">{{ $settings['ceremony_time'] ?? '15:00' }} hrs</p>
                        <p class="text-sm text-gray-500 mb-6">{{ $settings['ceremony_place'] ?? '' }}<br>{{ $settings['ceremony_address'] ?? '' }}</p>
                        <a href="{{ $settings['ceremony_map_url'] ?? '#' }}" target="_blank"
                           class="inline-block border border-olive text-olive px-6 py-2 rounded-full hover:bg-olive hover:text-white transition text-sm">Ver en Mapa</a>
                    </div>
                    <!-- Recepción -->
                    <div class="bg-white p-8 rounded-xl shadow-lg border-t-4 border-olive text-center fade-in-up" style="transition-delay: 150ms;" x-intersect="$el.classList.add('visible')">
                        <svg class="w-12 h-12 mx-auto text-gold mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2v10z"/></svg>
                        <h3 class="font-serif text-2xl text-olive mb-2">Recepción</h3>
                        <p class="font-bold text-gray-800 mb-1">{{ $settings['wedding_date_text'] ?? '' }}</p>
                        <p class="text-gray-600 mb-4">{{ $settings['reception_time'] ?? '17:00' }} hrs</p>
                        <p class="text-sm text-gray-500 mb-6">{{ $settings['reception_place'] ?? '' }}<br>{{ $settings['reception_address'] ?? '' }}</p>
                        <a href="{{ $settings['reception_map_url'] ?? '#' }}" target="_blank"
                           class="inline-block border border-olive text-olive px-6 py-2 rounded-full hover:bg-olive hover:text-white transition text-sm">Ver en Mapa</a>
                    </div>
                </div>
            </div>
        </section>

        {{-- 5. TU LUGAR --}}
        <section class="py-20 bg-ivory">
            <div class="container mx-auto px-4 max-w-xl text-center fade-in-up" x-intersect="$el.classList.add('visible')">
                <h2 class="font-script text-5xl text-olive mb-6">Tu Lugar</h2>
                <div class="bg-white p-8 rounded-2xl shadow-xl border border-beige relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-olive to-gold"></div>
                    <div class="p-6 bg-beige/30 rounded-xl border border-gold/30">
                        <p class="font-sans text-sm text-gray-500 uppercase tracking-widest mb-2">Con mucho cariño para</p>
                        <h4 class="font-script text-4xl text-olive mb-6">{{ $guest->name }}</h4>
                        <div class="grid grid-cols-2 gap-4 text-left">
                            <div class="bg-white p-4 rounded-lg shadow-sm border-l-4 border-olive">
                                <span class="block text-xs text-gray-500 uppercase mb-1">Mesa</span>
                                <span class="font-bold text-xl text-gray-800">{{ $guest->table_name ?? 'Por confirmar' }}</span>
                            </div>
                            <div class="bg-white p-4 rounded-lg shadow-sm border-l-4 border-gold">
                                <span class="block text-xs text-gray-500 uppercase mb-1">Pases</span>
                                <span class="font-bold text-xl text-gray-800">{{ $guest->tickets }}</span>
                                @if($guest->seats)
                                    <span class="block text-xs text-gray-400 italic mt-1">Asientos: {{ $guest->seats }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- 6. VIDEO PERSONALIZADO --}}
        @if($guest->embed_video_url)
        <section class="py-20 bg-olive text-white relative">
            <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
            <div class="container mx-auto px-4 max-w-4xl text-center relative z-10 fade-in-up" x-intersect="$el.classList.add('visible')">
                <h2 class="font-serif text-3xl md:text-4xl text-gold mb-4 italic">Un Mensaje para Ti</h2>
                <p class="font-sans font-light mb-10 opacity-90">Queremos compartir nuestra felicidad contigo, {{ explode(' ', $guest->name)[0] }}.</p>
                <div class="relative p-2 md:p-4 bg-wood/40 rounded-2xl shadow-2xl border border-gold/30">
                    <div class="w-full rounded-xl overflow-hidden shadow-inner" style="padding-top:56.25%;position:relative;">
                        <iframe src="{{ $guest->embed_video_url }}" frameborder="0" allowfullscreen
                            style="position:absolute;top:0;left:0;width:100%;height:100%;" class="rounded-xl"></iframe>
                    </div>
                </div>
            </div>
        </section>
        @endif

        {{-- 7. CONFIRMACIÓN DE ASISTENCIA --}}
        <section class="py-20 bg-beige relative overflow-hidden">
            <div class="container mx-auto px-4 max-w-2xl fade-in-up" x-intersect="$el.classList.add('visible')">
                <div class="bg-white p-10 rounded-3xl shadow-xl relative z-10">
                    <div class="text-center mb-8">
                        <h2 class="font-script text-5xl text-olive mb-2">Confirmación</h2>
                        <p class="text-gray-600 text-sm">Por favor confirma tu asistencia a tiempo.</p>
                    </div>

                    @if($rsvp_submitted)
                        <div class="text-center py-8">
                            <svg class="w-16 h-16 text-green-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <h3 class="font-serif text-2xl text-olive mb-2">¡Gracias, {{ explode(' ', $guest->name)[0] }}!</h3>
                            <p class="text-gray-500 text-sm">Hemos recibido tu confirmación. ¡Te esperamos con mucho cariño!</p>
                            @if($guest->confirmed)
                                <p class="mt-4 font-semibold text-olive">✓ Asistirás con {{ $guest->confirmed_tickets }} {{ $guest->confirmed_tickets == 1 ? 'persona' : 'personas' }}</p>
                            @else
                                <p class="mt-4 text-gray-500 italic">Lamentamos que no puedas asistir.</p>
                            @endif
                        </div>
                    @else
                        <form class="space-y-6" wire:submit.prevent="confirmRsvp">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nombre del invitado</label>
                                <input type="text" wire:model="rsvp_name" readonly
                                    class="w-full border-b-2 border-gray-200 px-3 py-2 bg-gray-50 text-gray-700 rounded focus:outline-none text-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Número de asistentes (máx. {{ $guest->tickets }})</label>
                                <select wire:model="rsvp_tickets"
                                    class="w-full border-b-2 border-gray-300 px-3 py-2 focus:outline-none focus:border-olive transition bg-transparent">
                                    @for($i = 1; $i <= $guest->tickets; $i++)
                                        <option value="{{ $i }}">{{ $i }} {{ $i == 1 ? 'persona' : 'personas' }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-3">¿Asistirás?</label>
                                <div class="flex gap-4">
                                    <label class="flex-1 flex items-center justify-center gap-2 cursor-pointer p-3 rounded-xl border-2 transition"
                                           :class="rsvp_attending ? 'border-olive bg-olive/10 text-olive font-semibold' : 'border-gray-200'">
                                        <input type="radio" wire:model="rsvp_attending" value="1" class="hidden">
                                        <span>✓ Sí, ahí estaré</span>
                                    </label>
                                    <label class="flex-1 flex items-center justify-center gap-2 cursor-pointer p-3 rounded-xl border-2 transition"
                                           :class="!rsvp_attending ? 'border-red-400 bg-red-50 text-red-600 font-semibold' : 'border-gray-200'">
                                        <input type="radio" wire:model="rsvp_attending" value="0" class="hidden">
                                        <span>✗ No podré asistir</span>
                                    </label>
                                </div>
                            </div>
                            <div class="pt-2 text-center">
                                <button type="submit"
                                    class="bg-olive text-white px-10 py-3 rounded-full hover:bg-[#435522] transition shadow-lg uppercase tracking-wide text-sm glow-btn">
                                    <span wire:loading.remove>Confirmar Asistencia</span>
                                    <span wire:loading>Enviando...</span>
                                </button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </section>

        {{-- 8. MESA DE REGALOS --}}
        @if(!empty($settings['bank_clabe']))
        <section class="py-20 bg-ivory">
            <div class="container mx-auto px-4 max-w-3xl text-center fade-in-up" x-intersect="$el.classList.add('visible')">
                <svg class="w-16 h-16 mx-auto text-gold mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"/></svg>
                <h2 class="font-script text-5xl text-olive mb-4">Mesa de Regalos</h2>
                <p class="text-gray-600 mb-8 text-sm">Tu presencia es nuestro mejor regalo. Si deseas obsequiarnos algo, puedes hacerlo a través de:</p>
                <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100 max-w-sm mx-auto" x-data="{ copied: false }">
                    <p class="text-sm text-gray-500 mb-1">{{ $settings['bank_name'] ?? '' }}</p>
                    <p class="font-bold text-gray-800 mb-1">{{ $settings['bank_holder'] ?? '' }}</p>
                    <p class="font-mono text-xl font-bold text-olive tracking-widest my-4">{{ $settings['bank_clabe'] ?? '' }}</p>
                    <button @click="navigator.clipboard.writeText('{{ $settings['bank_clabe'] ?? '' }}'); copied = true; setTimeout(() => copied = false, 2000)"
                        class="border border-olive text-olive px-6 py-2 rounded-full text-sm hover:bg-olive hover:text-white transition">
                        <span x-show="!copied">📋 Copiar CLABE</span>
                        <span x-show="copied" x-cloak class="text-green-600">✓ ¡Copiado!</span>
                    </button>
                </div>
            </div>
        </section>
        @endif

    </div>

    <script>
        function invitacion() {
            const weddingDate = new Date('{{ $settings['wedding_date'] ?? '2026-12-18' }}T{{ $settings['ceremony_time'] ?? '15:00' }}:00');
            return {
                musicPlaying: false,
                days: '00', hours: '00', minutes: '00', seconds: '00',
                rsvp_attending: true,
                init() {
                    this.startCountdown();
                    
                    // Attempt autoplay right away
                    this.playMusicSilent();
                    
                    // Fallback: play on first user interaction anywhere on the page
                    const playOnInteraction = () => {
                        this.playMusic();
                        document.removeEventListener('click', playOnInteraction);
                        document.removeEventListener('touchstart', playOnInteraction);
                    };
                    document.addEventListener('click', playOnInteraction, { passive: true });
                    document.addEventListener('touchstart', playOnInteraction, { passive: true });
                },
                startCountdown() {
                    this.updateCountdown();
                    setInterval(() => this.updateCountdown(), 1000);
                },
                updateCountdown() {
                    const diff = weddingDate - new Date();
                    if (diff <= 0) { this.days = this.hours = this.minutes = this.seconds = '00'; return; }
                    this.days    = String(Math.floor(diff / 86400000)).padStart(2, '0');
                    this.hours   = String(Math.floor((diff % 86400000) / 3600000)).padStart(2, '0');
                    this.minutes = String(Math.floor((diff % 3600000) / 60000)).padStart(2, '0');
                    this.seconds = String(Math.floor((diff % 60000) / 1000)).padStart(2, '0');
                },
                playMusic() {
                    const audio = document.getElementById('bg-music');
                    if (audio && audio.paused) {
                        audio.play().then(() => {
                            this.musicPlaying = true;
                        }).catch(err => {
                            console.log("Audio play blocked:", err);
                        });
                    }
                },
                playMusicSilent() {
                    const audio = document.getElementById('bg-music');
                    if (audio) {
                        audio.play().then(() => {
                            this.musicPlaying = true;
                        }).catch(() => {
                            this.musicPlaying = false;
                        });
                    }
                },
                toggleMusic() {
                    const audio = document.getElementById('bg-music');
                    if (audio) {
                        if (this.musicPlaying) {
                            audio.pause();
                            this.musicPlaying = false;
                        } else {
                            audio.play().then(() => {
                                this.musicPlaying = true;
                            });
                        }
                    }
                }
            }
        }
    </script>
</div>
