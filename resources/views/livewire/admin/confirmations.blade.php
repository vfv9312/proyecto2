<div class="p-6 font-sans text-gray-800">
    <h1 class="text-2xl font-bold text-gray-900 mb-1">Confirmaciones de Asistencia</h1>
    <p class="text-sm text-gray-500 mb-6">Ve quiénes han confirmado y su mesa asignada.</p>

    {{-- Stats --}}
    <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-6">
        <div class="bg-white rounded-xl p-4 border shadow-sm text-center">
            <p class="text-3xl font-bold text-gray-800">{{ $stats['total_guests'] }}</p>
            <p class="text-xs text-gray-500 mt-1">Total Familias</p>
        </div>
        <div class="bg-white rounded-xl p-4 border shadow-sm text-center">
            <p class="text-3xl font-bold text-indigo-600">{{ $stats['total_tickets'] }}</p>
            <p class="text-xs text-gray-500 mt-1">Pases Totales</p>
        </div>
        <div class="bg-white rounded-xl p-4 border shadow-sm text-center">
            <p class="text-3xl font-bold text-green-600">{{ $stats['confirmed_guests'] }}</p>
            <p class="text-xs text-gray-500 mt-1">Familias Confirmadas</p>
        </div>
        <div class="bg-white rounded-xl p-4 border shadow-sm text-center">
            <p class="text-3xl font-bold text-green-700">{{ $stats['confirmed_tickets'] }}</p>
            <p class="text-xs text-gray-500 mt-1">Pases Confirmados</p>
        </div>
        <div class="bg-white rounded-xl p-4 border shadow-sm text-center">
            <p class="text-3xl font-bold text-amber-500">{{ $stats['pending_guests'] }}</p>
            <p class="text-xs text-gray-500 mt-1">Sin Confirmar</p>
        </div>
    </div>

    {{-- Barra de progreso --}}
    @php
        $pct = $stats['total_tickets'] > 0 ? round(($stats['confirmed_tickets'] / $stats['total_tickets']) * 100) : 0;
    @endphp
    <div class="bg-white rounded-xl border shadow-sm p-4 mb-6">
        <div class="flex justify-between items-center mb-2">
            <span class="text-sm font-semibold text-gray-700">Progreso de confirmaciones</span>
            <span class="text-sm font-bold text-green-700">{{ $pct }}%</span>
        </div>
        <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
            <div class="bg-green-600 h-3 rounded-full transition-all duration-700" style="width: {{ $pct }}%"></div>
        </div>
        <p class="text-xs text-gray-400 mt-2">{{ $stats['confirmed_tickets'] }} de {{ $stats['total_tickets'] }} pases confirmados</p>
    </div>

    {{-- Filtros --}}
    <div class="flex flex-col md:flex-row gap-3 mb-4">
        <div class="relative flex-1">
            <svg class="absolute left-3 top-3 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            <input type="text" wire:model.live="search" placeholder="Buscar por nombre..." class="w-full pl-10 pr-4 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
        </div>
        <select wire:model.live="filterConfirmed" class="border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
            <option value="">Todos</option>
            <option value="1">Confirmados</option>
            <option value="0">Pendientes</option>
        </select>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-xl border shadow-sm overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="text-left px-4 py-3 font-semibold text-gray-600">Nombre</th>
                    <th class="text-center px-4 py-3 font-semibold text-gray-600">Estado</th>
                    <th class="text-center px-4 py-3 font-semibold text-gray-600">Pases</th>
                    <th class="text-center px-4 py-3 font-semibold text-gray-600">Confirmados</th>
                    <th class="text-left px-4 py-3 font-semibold text-gray-600">Mesa</th>
                    <th class="text-left px-4 py-3 font-semibold text-gray-600">Asientos</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($guests as $guest)
                <tr class="hover:bg-gray-50 transition {{ $guest->confirmed ? '' : 'opacity-75' }}">
                    <td class="px-4 py-3 font-medium text-gray-800">{{ $guest->name }}</td>
                    <td class="px-4 py-3 text-center">
                        @if($guest->confirmed)
                            <span class="bg-green-100 text-green-700 text-xs font-semibold px-2 py-1 rounded-full">✓ Confirmado</span>
                        @else
                            <span class="bg-amber-100 text-amber-700 text-xs font-semibold px-2 py-1 rounded-full">⏳ Pendiente</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-center font-semibold">{{ $guest->tickets }}</td>
                    <td class="px-4 py-3 text-center">
                        @if($guest->confirmed)
                            <span class="font-bold text-green-700">{{ $guest->confirmed_tickets }}</span>
                        @else
                            <span class="text-gray-400">—</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-gray-600">{{ $guest->table_name ?? '—' }}</td>
                    <td class="px-4 py-3 text-gray-600">{{ $guest->seats ?? '—' }}</td>
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
</div>
