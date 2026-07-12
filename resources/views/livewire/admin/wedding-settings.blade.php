<div class="p-6 font-sans text-gray-800 max-w-3xl">
    @if(session()->has('message'))
        <div class="mb-4 px-4 py-3 bg-green-100 border border-green-400 text-green-800 rounded-lg flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            {{ session('message') }}
        </div>
    @endif

    <h1 class="text-2xl font-bold text-gray-900 mb-1">Configuración de la Boda</h1>
    <p class="text-sm text-gray-500 mb-6">Personaliza la información que aparece en la invitación pública.</p>

    <div class="bg-white rounded-xl border shadow-sm p-6 space-y-6">
        {{-- Novios --}}
        <div>
            <h3 class="font-semibold text-gray-700 mb-3 pb-2 border-b">👰 Los Novios</h3>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="text-sm font-medium text-gray-600 mb-1 block">Nombre de la novia</label>
                    <input type="text" wire:model="bride_name" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:outline-none">
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-600 mb-1 block">Nombre del novio</label>
                    <input type="text" wire:model="groom_name" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:outline-none">
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-600 mb-1 block">Fecha (texto visible)</label>
                    <input type="text" wire:model="wedding_date_text" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:outline-none" placeholder="Ej: 18 de Diciembre, 2026">
                </div>
            </div>
        </div>

        {{-- Ceremonia --}}
        <div>
            <h3 class="font-semibold text-gray-700 mb-3 pb-2 border-b">⛪ Ceremonia</h3>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="text-sm font-medium text-gray-600 mb-1 block">Hora</label>
                    <input type="text" wire:model="ceremony_time" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:outline-none">
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-600 mb-1 block">Lugar</label>
                    <input type="text" wire:model="ceremony_place" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:outline-none">
                </div>
                <div class="col-span-2">
                    <label class="text-sm font-medium text-gray-600 mb-1 block">Dirección</label>
                    <input type="text" wire:model="ceremony_address" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:outline-none">
                </div>
                <div class="col-span-2">
                    <label class="text-sm font-medium text-gray-600 mb-1 block">Link Google Maps</label>
                    <input type="url" wire:model="ceremony_map_url" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:outline-none">
                </div>
            </div>
        </div>

        {{-- Recepción --}}
        <div>
            <h3 class="font-semibold text-gray-700 mb-3 pb-2 border-b">🎉 Recepción</h3>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="text-sm font-medium text-gray-600 mb-1 block">Hora</label>
                    <input type="text" wire:model="reception_time" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:outline-none">
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-600 mb-1 block">Lugar</label>
                    <input type="text" wire:model="reception_place" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:outline-none">
                </div>
                <div class="col-span-2">
                    <label class="text-sm font-medium text-gray-600 mb-1 block">Dirección</label>
                    <input type="text" wire:model="reception_address" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:outline-none">
                </div>
                <div class="col-span-2">
                    <label class="text-sm font-medium text-gray-600 mb-1 block">Link Google Maps</label>
                    <input type="url" wire:model="reception_map_url" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:outline-none">
                </div>
            </div>
        </div>

        {{-- Banco --}}
        <div>
            <h3 class="font-semibold text-gray-700 mb-3 pb-2 border-b">💳 Mesa de Regalos</h3>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="text-sm font-medium text-gray-600 mb-1 block">Banco</label>
                    <input type="text" wire:model="bank_name" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:outline-none">
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-600 mb-1 block">Titular</label>
                    <input type="text" wire:model="bank_holder" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:outline-none">
                </div>
                <div class="col-span-2">
                    <label class="text-sm font-medium text-gray-600 mb-1 block">CLABE</label>
                    <input type="text" wire:model="bank_clabe" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:outline-none">
                </div>
            </div>
        </div>

        {{-- Multimedia --}}
        <div>
            <h3 class="font-semibold text-gray-700 mb-4 pb-2 border-b">🎵 Multimedia</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Música de Fondo -->
                <div class="bg-gray-50 p-4 rounded-xl border border-gray-200">
                    <label class="text-sm font-semibold text-gray-700 mb-2 block">🎵 Música de Fondo</label>
                    
                    @if($music_url)
                        <div class="mb-3">
                            <span class="text-xs text-gray-500 block mb-1">Música actual:</span>
                            <audio src="{{ $music_url }}" controls class="w-full h-8 max-w-full"></audio>
                        </div>
                    @endif

                    <div class="space-y-3">
                        <div>
                            <span class="text-xs text-gray-500 block mb-1">Subir archivo MP3</span>
                            <input type="file" wire:model="music_file" accept="audio/*" class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                            @error('music_file') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div wire:loading wire:target="music_file" class="text-xs text-green-600 font-medium">
                            ⏳ Subiendo archivo de música...
                        </div>
                        <div>
                            <span class="text-xs text-gray-500 block mb-1">O usar una URL directa de música</span>
                            <input type="text" wire:model="music_url" placeholder="https://ejemplo.com/musica.mp3" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:outline-none">
                        </div>
                    </div>
                </div>

                <!-- Imagen de Fondo -->
                <div class="bg-gray-50 p-4 rounded-xl border border-gray-200">
                    <label class="text-sm font-semibold text-gray-700 mb-2 block">🖼️ Imagen de Fondo (Hero)</label>
                    
                    @if($hero_image_url)
                        <div class="mb-3">
                            <span class="text-xs text-gray-500 block mb-1">Imagen actual:</span>
                            <img src="{{ $hero_image_url }}" alt="Hero Background" class="h-20 w-full object-cover rounded-lg border">
                        </div>
                    @endif

                    <div class="space-y-3">
                        <div>
                            <span class="text-xs text-gray-500 block mb-1">Subir nueva imagen</span>
                            <input type="file" wire:model="hero_image_file" accept="image/*" class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                            @error('hero_image_file') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div wire:loading wire:target="hero_image_file" class="text-xs text-green-600 font-medium">
                            ⏳ Subiendo imagen...
                        </div>
                        <div>
                            <span class="text-xs text-gray-500 block mb-1">O usar una URL directa de imagen</span>
                            <input type="text" wire:model="hero_image_url" placeholder="https://ejemplo.com/imagen.jpg" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:outline-none">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5 flex justify-end">
        <button wire:click="save" class="px-8 py-3 bg-green-700 text-white rounded-xl font-semibold hover:bg-green-800 transition shadow-md">
            <span wire:loading.remove>Guardar Cambios</span>
            <span wire:loading>Guardando...</span>
        </button>
    </div>
</div>
