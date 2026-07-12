<div class="p-6 font-sans text-gray-800">
    {{-- Flash Message --}}
    @if(session()->has('message'))
        <div class="mb-4 px-4 py-3 bg-green-100 border border-green-400 text-green-800 rounded-lg flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            {{ session('message') }}
        </div>
    @endif

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Gestión de Invitados</h1>
            <p class="text-sm text-gray-500 mt-1">Administra la lista de invitados y sus pases.</p>
        </div>
        <button wire:click="openCreate" class="bg-green-700 text-white px-5 py-2 rounded-lg hover:bg-green-800 transition flex items-center gap-2 text-sm font-semibold">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Nuevo Invitado
        </button>
    </div>

    {{-- Stats --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-xl p-4 border shadow-sm text-center">
            <p class="text-3xl font-bold text-gray-800">{{ $stats['total'] }}</p>
            <p class="text-xs text-gray-500 mt-1">Familias / Invitados</p>
        </div>
        <div class="bg-white rounded-xl p-4 border shadow-sm text-center">
            <p class="text-3xl font-bold text-indigo-600">{{ $stats['tickets'] }}</p>
            <p class="text-xs text-gray-500 mt-1">Pases Asignados</p>
        </div>
        <div class="bg-white rounded-xl p-4 border shadow-sm text-center">
            <p class="text-3xl font-bold text-green-600">{{ $stats['confirmed'] }}</p>
            <p class="text-xs text-gray-500 mt-1">Pases Confirmados</p>
        </div>
        <div class="bg-white rounded-xl p-4 border shadow-sm text-center">
            <p class="text-3xl font-bold text-amber-500">{{ $stats['pending'] }}</p>
            <p class="text-xs text-gray-500 mt-1">Pendientes por confirmar</p>
        </div>
    </div>

    {{-- Search --}}
    <div class="mb-4 flex items-center gap-3">
        <div class="relative flex-1">
            <svg class="absolute left-3 top-3 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            <input type="text" wire:model.live="search" placeholder="Buscar por nombre..." class="w-full pl-10 pr-4 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
        </div>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-xl border shadow-sm overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="text-left px-4 py-3 font-semibold text-gray-600">Nombre</th>
                    <th class="text-left px-4 py-3 font-semibold text-gray-600">Mesa</th>
                    <th class="text-center px-4 py-3 font-semibold text-gray-600">Pases</th>
                    <th class="text-center px-4 py-3 font-semibold text-gray-600">Estado</th>
                    <th class="text-left px-4 py-3 font-semibold text-gray-600">Link</th>
                    <th class="text-right px-4 py-3 font-semibold text-gray-600">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($guests as $guest)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-3 font-medium text-gray-800">{{ $guest->name }}</td>
                    <td class="px-4 py-3 text-gray-600">{{ $guest->table_name ?? '—' }}</td>
                    <td class="px-4 py-3 text-center">
                        <span class="font-semibold">{{ $guest->tickets }}</span>
                        @if($guest->confirmed)
                            <span class="text-green-600 text-xs">({{ $guest->confirmed_tickets }} conf.)</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-center">
                        @if($guest->confirmed)
                            <span class="bg-green-100 text-green-700 text-xs font-semibold px-2 py-1 rounded-full">Confirmado</span>
                        @else
                            <span class="bg-amber-100 text-amber-700 text-xs font-semibold px-2 py-1 rounded-full">Pendiente</span>
                        @endif
                    </td>
                    <td class="px-4 py-3">
                        <a href="{{ route('invitation', $guest->slug) }}" target="_blank" class="text-indigo-600 hover:underline text-xs truncate max-w-[120px] inline-block">/invitado/{{ $guest->slug }}</a>
                    </td>
                    <td class="px-4 py-3 text-right flex justify-end gap-2">
                        <button wire:click="openEdit({{ $guest->id }})" class="bg-indigo-100 text-indigo-700 hover:bg-indigo-200 px-3 py-1 rounded-lg text-xs font-semibold transition">Editar</button>
                        <button wire:click="confirmDelete({{ $guest->id }})" class="bg-red-100 text-red-700 hover:bg-red-200 px-3 py-1 rounded-lg text-xs font-semibold transition">Eliminar</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-4 py-10 text-center text-gray-400 italic">No hay invitados registrados.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-4 py-3 border-t">{{ $guests->links() }}</div>
    </div>

    {{-- Form Modal --}}
    @if($showForm)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg p-6 overflow-y-auto max-h-[90vh]">
            <h2 class="text-xl font-bold text-gray-800 mb-5">{{ $guestId ? 'Editar' : 'Nuevo' }} Invitado</h2>
            
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nombre del invitado / familia *</label>
                    <input type="text" wire:model="name" class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Ej: Familia Pérez López">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Pases asignados *</label>
                    <input type="number" wire:model="tickets" min="1" max="20" class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                    @error('tickets') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Mesa asignada</label>
                        <input type="text" wire:model="table_name" class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Ej: Mesa Los Pinos">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Asientos</label>
                        <input type="text" wire:model="seats" class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Ej: 3 y 4">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">URL de Video Personalizado</label>
                    <input type="url" wire:model="video_url" class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="https://youtube.com/embed/...">
                    @error('video_url') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Notas internas</label>
                    <textarea wire:model="notes" rows="2" class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Restricciones alimentarias, transporte, etc."></textarea>
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-6">
                <button wire:click="$set('showForm', false)" class="px-5 py-2 border rounded-lg text-sm text-gray-600 hover:bg-gray-50 transition">Cancelar</button>
                <button wire:click="save" class="px-5 py-2 bg-green-700 text-white rounded-lg text-sm font-semibold hover:bg-green-800 transition">
                    <span wire:loading.remove wire:target="save">Guardar</span>
                    <span wire:loading wire:target="save">Guardando...</span>
                </button>
            </div>
        </div>
    </div>
    @endif

    {{-- Delete Modal --}}
    @if($showDeleteModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-sm p-6 text-center">
            <svg class="w-12 h-12 text-red-500 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
            <h3 class="text-lg font-bold text-gray-800 mb-2">¿Eliminar invitado?</h3>
            <p class="text-sm text-gray-500 mb-5">Esta acción no se puede deshacer.</p>
            <div class="flex justify-center gap-3">
                <button wire:click="$set('showDeleteModal', false)" class="px-5 py-2 border rounded-lg text-sm text-gray-600 hover:bg-gray-50 transition">Cancelar</button>
                <button wire:click="delete" class="px-5 py-2 bg-red-600 text-white rounded-lg text-sm font-semibold hover:bg-red-700 transition">Sí, eliminar</button>
            </div>
        </div>
    </div>
    @endif
</div>
