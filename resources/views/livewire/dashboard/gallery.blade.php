<div>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Great+Vibes&family=Montserrat:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,600;1,400&display=swap');

        .font-script { font-family: 'Great Vibes', cursive; }
        .font-serif { font-family: 'Playfair Display', serif; }
        .font-sans { font-family: 'Montserrat', sans-serif; }

        .bg-ivory { background-color: #FFFFF0; }
        .bg-wood { background-color: #D2B48C; }
        .text-olive { color: #556B2F; }
        .bg-olive { background-color: #556B2F; }
        .text-gold { color: #D4AF37; }

        /* Floating Petals Animation */
        @keyframes fall {
            0% { opacity: 0; top: -10%; transform: translateX(0) rotate(0deg); }
            10% { opacity: 1; }
            20% { transform: translateX(-20px) rotate(45deg); }
            40% { transform: translateX(-40px) rotate(90deg); }
            60% { transform: translateX(20px) rotate(135deg); }
            80% { transform: translateX(-10px) rotate(180deg); }
            100% { top: 110%; transform: translateX(-30px) rotate(225deg); opacity: 0; }
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

        .fade-in-up {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 1s ease-out, transform 1s ease-out;
        }
        .fade-in-up.visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>

    <div class="bg-ivory font-sans text-gray-800 overflow-x-hidden min-h-screen pt-24" x-data="{ imgModal: false, imgModalSrc: '' }">
        
        <!-- Floating Petals -->
        <div class="fixed inset-0 pointer-events-none overflow-hidden" aria-hidden="true">
            @for ($i = 0; $i < 15; $i++)
                <div class="petal" style="left: {{ rand(5, 95) }}%; animation-delay: {{ rand(0, 10) }}s; animation-duration: {{ rand(8, 15) }}s;"></div>
            @endfor
        </div>

        <section class="py-20 bg-wood/10 min-h-screen relative z-10">
            <div class="container mx-auto px-4">
                <h2 class="font-script text-5xl md:text-7xl text-olive mb-4 text-center fade-in-up" x-intersect="$el.classList.add('visible')">Nuestros Momentos</h2>
                <p class="text-center font-serif text-lg italic text-gray-600 mb-10 fade-in-up" x-intersect="$el.classList.add('visible')">Sube tus fotos de la boda y sé parte de nuestros recuerdos.</p>
                
                <!-- Uploader Section -->
                <div class="max-w-xl mx-auto mb-16 bg-white p-6 rounded-2xl shadow-lg border border-beige fade-in-up" x-intersect="$el.classList.add('visible')">
                    <form class="flex flex-col items-center">
                        <label class="w-full flex flex-col items-center px-4 py-6 bg-white rounded-xl shadow-inner border-2 border-dashed border-gray-300 cursor-pointer hover:bg-gray-50 hover:border-olive transition relative overflow-hidden">
                            <div class="flex flex-col items-center">
                                <svg class="w-8 h-8 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                                </svg>
                                <span class="text-sm text-gray-500 font-medium">Haz clic aquí para seleccionar tus fotos</span>
                            </div>
                            
                            <div wire:loading wire:target="new_photos" class="text-sm text-olive flex flex-col items-center mt-3">
                                <svg class="animate-spin h-6 w-6 text-olive mb-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                <span class="text-xs font-semibold">Subiendo fotos...</span>
                            </div>
                            
                            <input type="file" wire:model.live="new_photos" class="hidden" accept="image/*" multiple>
                        </label>
                        
                        @error('new_photos') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
                        @error('new_photos.*') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
                        @if($successMessage) <span class="text-green-600 text-sm font-semibold mt-4 bg-green-100 px-4 py-2 rounded-lg">{{ $successMessage }}</span> @endif
                    </form>
                </div>
                
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4" wire:poll.10s>
                    <!-- Dynamic Gallery Items from Livewire component -->
                    @forelse ($this->photos as $index => $photoUrl)
                        <div wire:key="photo-{{ md5($photoUrl) }}" class="aspect-w-1 aspect-h-1 overflow-hidden rounded-lg shadow-sm cursor-pointer group fade-in-up" 
                             style="transition-delay: {{ ($index % 4) * 100 }}ms" x-intersect="$el.classList.add('visible')"
                             @click="imgModalSrc = '{{ $photoUrl }}'; imgModal = true">
                            <img src="{{ $photoUrl }}" 
                                 class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500" loading="lazy">
                            <div class="absolute inset-0 bg-olive/20 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center text-gray-500 font-serif italic my-10">
                            Aún no hay fotos. ¡Sé el primero en subir una!
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Lightbox Modal -->
            <div x-show="imgModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/90 p-4 backdrop-blur-sm"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0">
                <button @click="imgModal = false" class="absolute top-6 right-6 text-white hover:text-gold transition">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
                <img :src="imgModalSrc" class="max-w-full max-h-[90vh] object-contain rounded shadow-2xl" @click.away="imgModal = false">
            </div>
        </section>
    </div>
</div>
