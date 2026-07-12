<div>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Great+Vibes&family=Montserrat:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;1,400&display=swap');

        .font-script { font-family: 'Great Vibes', cursive; }
        .font-serif-disp { font-family: 'Playfair Display', serif; }
        .font-body { font-family: 'Montserrat', sans-serif; }

        .bg-ivory { background-color: #FFFFF0; }
        .bg-beige { background-color: #F5F5DC; }
        .text-olive { color: #556B2F; }
        .bg-olive { background-color: #556B2F; }
        .text-gold { color: #D4AF37; }
        .bg-gold { background-color: #D4AF37; }
        .border-gold { border-color: #D4AF37; }
        .bg-wood { background-color: #D2B48C; }

        /* Floating Petals */
        @keyframes fall {
            0%   { opacity: 0; top: -10%; transform: translateX(0) rotate(0deg); }
            10%  { opacity: 1; }
            50%  { transform: translateX(-30px) rotate(90deg); }
            100% { top: 110%; transform: translateX(20px) rotate(225deg); opacity: 0; }
        }
        .petal {
            position: absolute;
            width: 14px;
            height: 14px;
            background: #f7e1d7;
            border-radius: 14px 0 14px 0;
            opacity: 0;
            animation: fall 12s infinite linear;
        }

        /* Fade in */
        .fade-in-up {
            opacity: 0;
            transform: translateY(40px);
            transition: opacity 0.9s ease-out, transform 0.9s ease-out;
        }
        .fade-in-up.visible { opacity: 1; transform: translateY(0); }

        /* Hero */
        .hero-bg {
            background-image: linear-gradient(rgba(0,0,0,0.45), rgba(0,0,0,0.6)),
                url('https://images.unsplash.com/photo-1519225421980-715cb0215aed?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        /* Shimmer badge */
        @keyframes shimmer {
            0%   { background-position: -200% center; }
            100% { background-position: 200% center; }
        }
        .shimmer-badge {
            background: linear-gradient(90deg, #D4AF37, #fff6c7, #D4AF37);
            background-size: 200% auto;
            animation: shimmer 3s linear infinite;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Feature card hover */
        .feature-card:hover { transform: translateY(-6px); box-shadow: 0 20px 60px rgba(85,107,47,0.15); }
        .feature-card { transition: all 0.35s ease; }

        /* Sample preview */
        .preview-frame {
            border-radius: 20px;
            box-shadow: 0 30px 80px rgba(0,0,0,0.3);
            overflow: hidden;
        }

        /* CTA pulse */
        @keyframes pulse-ring {
            0%   { transform: scale(1); opacity: 0.7; }
            70%  { transform: scale(1.15); opacity: 0; }
            100% { transform: scale(1.15); opacity: 0; }
        }
        .cta-pulse::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 9999px;
            background: #D4AF37;
            animation: pulse-ring 2s ease-out infinite;
            z-index: -1;
        }
    </style>

    <div class="bg-ivory font-body text-gray-800 overflow-x-hidden" x-data="{}">

        <!-- Floating Petals -->
        <div class="fixed inset-0 pointer-events-none overflow-hidden z-0" aria-hidden="true">
            @for ($i = 0; $i < 18; $i++)
                <div class="petal" style="left: {{ rand(3, 97) }}%; animation-delay: {{ rand(0, 12) }}s; animation-duration: {{ rand(8, 18) }}s;"></div>
            @endfor
        </div>

        {{-- ─────────────────────────────────────────────
             HERO SECTION
        ───────────────────────────────────────────── --}}
        <section class="hero-bg relative min-h-screen flex items-center justify-center text-white overflow-hidden">
            <div class="relative z-10 text-center px-6 max-w-4xl mx-auto" x-data="{ show: false }" x-init="setTimeout(() => show = true, 300)">

                <div :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'" class="transition-all duration-1000">

                    <p class="shimmer-badge text-sm md:text-base font-bold tracking-[0.3em] uppercase mb-6">
                        ✦ Invitaciones Digitales de Boda ✦
                    </p>

                    <h1 class="font-script text-7xl md:text-9xl mb-6 drop-shadow-xl leading-none">
                        Tu Gran Día,<br>Contado al Mundo
                    </h1>

                    <p class="font-serif-disp text-lg md:text-2xl italic text-white/90 mb-10 max-w-2xl mx-auto">
                        Crea una invitación digital única y personalizada para cada invitado,
                        con confirmaciones en tiempo real y galería de fotos colaborativa.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                        <a href="{{ route('login') }}" class="relative cta-pulse inline-flex items-center gap-3 bg-gold text-gray-900 font-bold px-10 py-4 rounded-full text-base hover:scale-105 transition-transform shadow-xl">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            Crear Mi Invitación
                        </a>
                        <a href="#features" @click.prevent="document.getElementById('features').scrollIntoView({behavior:'smooth'})"
                           class="inline-flex items-center gap-2 border-2 border-white/60 text-white px-8 py-4 rounded-full text-base hover:bg-white/10 transition">
                            Ver características
                            <svg class="w-4 h-4 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Scroll indicator -->
            <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 opacity-60">
                <span class="text-xs tracking-widest uppercase text-white">Descubre</span>
                <div class="w-px h-10 bg-gradient-to-b from-white to-transparent"></div>
            </div>
        </section>

        {{-- ─────────────────────────────────────────────
             FEATURES
        ───────────────────────────────────────────── --}}
        <section id="features" class="py-24 bg-white">
            <div class="container mx-auto px-6 max-w-6xl">
                <div class="text-center mb-16 fade-in-up" x-intersect="$el.classList.add('visible')">
                    <span class="text-olive text-sm font-bold tracking-widest uppercase">¿Por qué elegirnos?</span>
                    <h2 class="font-script text-5xl md:text-6xl text-olive mt-3 mb-4">Todo lo que necesitas</h2>
                    <p class="text-gray-500 text-base max-w-xl mx-auto font-serif-disp italic">Una plataforma completa para gestionar tu boda digital de principio a fin.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                    @php
                    $features = [
                        ['icon' => 'M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z', 'color' => 'olive', 'bg' => '#556B2F', 'title' => 'Personalización Total', 'desc' => 'Cada invitado recibe su propia URL con su nombre, mesa asignada, número de pases y hasta un video dedicado.'],
                        ['icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4', 'color' => 'indigo', 'bg' => '#4F46E5', 'title' => 'Confirmaciones en Tiempo Real', 'desc' => 'Tus invitados confirman asistencia directamente en su invitación. Tú ves el conteo instantáneo desde el panel.'],
                        ['icon' => 'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z', 'color' => 'amber', 'bg' => '#D97706', 'title' => 'Galería Colaborativa', 'desc' => 'Los invitados suben sus fotos de la boda y se agregan automáticamente a una galería compartida en tiempo real.'],
                        ['icon' => 'M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z', 'color' => 'rose', 'bg' => '#E11D48', 'title' => 'Mesa de Regalos', 'desc' => 'Incluye tus datos bancarios de forma elegante para que los invitados puedan obsequiarte fácilmente.'],
                        ['icon' => 'M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3', 'color' => 'purple', 'bg' => '#7C3AED', 'title' => 'Música de Fondo', 'desc' => 'Personaliza la canción de fondo de la invitación para crear una atmósfera romántica desde el primer segundo.'],
                        ['icon' => 'M12 18h.01M8 21h8a2 2 0 002-2v-1a4 4 0 00-4-4H8a4 4 0 00-4 4v1a2 2 0 002 2zM12 11a4 4 0 100-8 4 4 0 000 8z', 'color' => 'teal', 'bg' => '#0D9488', 'title' => 'Panel de Administración', 'desc' => 'Gestiona todos tus invitados, genera sus links únicos y controla mesas y asientos desde un solo lugar.'],
                    ];
                    @endphp

                    @foreach($features as $i => $f)
                    <div class="feature-card bg-white rounded-2xl p-8 border border-gray-100 shadow-sm fade-in-up"
                         style="transition-delay: {{ $i * 80 }}ms"
                         x-intersect="$el.classList.add('visible')">
                        <div class="w-14 h-14 rounded-2xl flex items-center justify-center mb-5" style="background-color: {{ $f['bg'] }}1A;">
                            <svg class="w-7 h-7" style="color: {{ $f['bg'] }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="{{ $f['icon'] }}"/>
                            </svg>
                        </div>
                        <h3 class="font-bold text-gray-900 text-lg mb-2">{{ $f['title'] }}</h3>
                        <p class="text-gray-500 text-sm leading-relaxed">{{ $f['desc'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- ─────────────────────────────────────────────
             PREVIEW / MOCKUP
        ───────────────────────────────────────────── --}}
        <section class="py-24 bg-ivory">
            <div class="container mx-auto px-6 max-w-6xl">
                <div class="grid md:grid-cols-2 gap-16 items-center">
                    <div class="fade-in-up" x-intersect="$el.classList.add('visible')">
                        <span class="text-olive text-sm font-bold tracking-widest uppercase">Diseño premium</span>
                        <h2 class="font-script text-5xl md:text-6xl text-olive mt-3 mb-6">Romántico y Elegante</h2>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            Nuestra invitación cuenta con un diseño campestre elegante con pétalos animados, tipografía exclusiva, cuenta regresiva en vivo y mucho más.
                        </p>
                        <ul class="space-y-3 mb-8">
                            @foreach(['Pétalos cayendo animados', 'Cuenta regresiva en tiempo real', 'Mapa al lugar del evento', 'Sección "Nuestra Historia"', 'Confirmación de asistencia integrada'] as $item)
                            <li class="flex items-center gap-3 text-gray-700 text-sm">
                                <span class="w-6 h-6 rounded-full bg-olive flex items-center justify-center flex-shrink-0">
                                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                </span>
                                {{ $item }}
                            </li>
                            @endforeach
                        </ul>
                        <a href="{{ route('login') }}" class="inline-flex items-center gap-2 bg-olive text-white px-8 py-3 rounded-full font-semibold hover:bg-[#435522] transition shadow-md text-sm">
                            Comenzar ahora — Es gratis
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                    </div>

                    <div class="fade-in-up" style="transition-delay: 200ms" x-intersect="$el.classList.add('visible')">
                        <div class="preview-frame">
                            <img src="https://images.unsplash.com/photo-1519741497674-611481863552?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                                 alt="Preview de invitación de boda"
                                 class="w-full h-full object-cover">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- ─────────────────────────────────────────────
             HOW IT WORKS
        ───────────────────────────────────────────── --}}
        <section class="py-24 bg-olive text-white relative overflow-hidden">
            <div class="absolute inset-0 opacity-5" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
            <div class="container mx-auto px-6 max-w-5xl relative z-10">
                <div class="text-center mb-16 fade-in-up" x-intersect="$el.classList.add('visible')">
                    <h2 class="font-script text-5xl md:text-6xl text-gold mb-4">¿Cómo funciona?</h2>
                    <p class="text-white/80 font-serif-disp italic">En tres sencillos pasos</p>
                </div>
                <div class="grid md:grid-cols-3 gap-10">
                    @foreach([
                        ['num' => '01', 'title' => 'Personaliza tu boda', 'desc' => 'Ingresa los datos de tu evento: nombres, fechas, lugares, música y más desde el panel de administración.'],
                        ['num' => '02', 'title' => 'Agrega tus invitados', 'desc' => 'Crea cada invitado con su nombre, número de pases, mesa asignada y si quieres, un video personalizado.'],
                        ['num' => '03', 'title' => 'Comparte el link', 'desc' => 'Cada invitado recibe una URL única. Ellos confirman asistencia y tú ves todo en tiempo real.'],
                    ] as $i => $step)
                    <div class="text-center fade-in-up" style="transition-delay: {{ $i * 150 }}ms" x-intersect="$el.classList.add('visible')">
                        <div class="text-gold font-script text-7xl mb-4 opacity-80">{{ $step['num'] }}</div>
                        <h3 class="font-bold text-xl mb-3">{{ $step['title'] }}</h3>
                        <p class="text-white/70 text-sm leading-relaxed">{{ $step['desc'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- ─────────────────────────────────────────────
             TESTIMONIAL / QUOTE
        ───────────────────────────────────────────── --}}
        <section class="py-24 bg-beige">
            <div class="container mx-auto px-6 max-w-3xl text-center fade-in-up" x-intersect="$el.classList.add('visible')">
                <svg class="w-12 h-12 text-gold mx-auto mb-6 opacity-60" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                </svg>
                <p class="font-serif-disp text-2xl md:text-3xl italic text-gray-700 mb-8 leading-relaxed">
                    "Nuestros invitados quedaron sorprendidos con la invitación digital. La funcionalidad de confirmación en tiempo real nos ayudó a organizar todo sin estrés."
                </p>
                <div class="flex items-center justify-center gap-3">
                    <div class="w-12 h-12 rounded-full bg-olive flex items-center justify-center text-white font-bold">M</div>
                    <div class="text-left">
                        <p class="font-semibold text-gray-800">María & Roberto</p>
                        <p class="text-sm text-gray-500">Boda en Tuxtla Gutiérrez, 2025</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- ─────────────────────────────────────────────
             FINAL CTA
        ───────────────────────────────────────────── --}}
        <section class="py-24 bg-white">
            <div class="container mx-auto px-6 max-w-2xl text-center fade-in-up" x-intersect="$el.classList.add('visible')">
                <h2 class="font-script text-6xl md:text-7xl text-olive mb-4">¡Tu boda merece lo mejor!</h2>
                <p class="text-gray-500 mb-10 font-serif-disp italic text-lg">Crea tu invitación digital hoy mismo — elegante, personalizada y completamente gratis.</p>
                <a href="{{ route('login') }}"
                   class="relative inline-flex items-center gap-3 bg-olive text-white font-bold px-12 py-5 rounded-full text-lg hover:bg-[#435522] transition-all shadow-2xl hover:shadow-olive/30 hover:-translate-y-1">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    Crear Mi Invitación Gratis
                </a>
                <p class="mt-5 text-xs text-gray-400">Sin tarjeta de crédito. Lista en minutos.</p>
            </div>
        </section>

    </div>
</div>
