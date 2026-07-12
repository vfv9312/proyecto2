<div class="p-6 font-sans text-gray-800">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900">Panel de Administración</h1>
        <p class="text-sm text-gray-500 mt-1">Bienvenido. Desde aquí puedes gestionar la boda.</p>
    </div>

    {{-- Accesos Rápidos: Boda --}}
    <h2 class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-4">🌿 Gestión de la Boda</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-10">

        <a href="{{ route('admin.guests') }}" class="group bg-white rounded-2xl border shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 p-6 flex items-start gap-4">
            <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center flex-shrink-0 group-hover:bg-green-700 transition-colors">
                <svg class="w-6 h-6 text-green-700 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <div>
                <h3 class="font-semibold text-gray-800 mb-1">Invitados</h3>
                <p class="text-sm text-gray-500">Crea y administra la lista de invitados, pases y mesas asignadas.</p>
            </div>
        </a>

        <a href="{{ route('admin.confirmations') }}" class="group bg-white rounded-2xl border shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 p-6 flex items-start gap-4">
            <div class="w-12 h-12 rounded-xl bg-indigo-100 flex items-center justify-center flex-shrink-0 group-hover:bg-indigo-700 transition-colors">
                <svg class="w-6 h-6 text-indigo-700 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                </svg>
            </div>
            <div>
                <h3 class="font-semibold text-gray-800 mb-1">Confirmaciones</h3>
                <p class="text-sm text-gray-500">Ve quiénes han confirmado asistencia y cuántos pases han tomado.</p>
            </div>
        </a>

        <a href="{{ route('admin.settings') }}" class="group bg-white rounded-2xl border shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 p-6 flex items-start gap-4">
            <div class="w-12 h-12 rounded-xl bg-amber-100 flex items-center justify-center flex-shrink-0 group-hover:bg-amber-600 transition-colors">
                <svg class="w-6 h-6 text-amber-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <div>
                <h3 class="font-semibold text-gray-800 mb-1">Configuración</h3>
                <p class="text-sm text-gray-500">Edita nombres, fechas, lugares, datos bancarios y multimedia.</p>
            </div>
        </a>
    </div>

    {{-- Tabla de Usuarios --}}
    <h2 class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-4">👥 Usuarios del Sistema</h2>
    <div class="bg-white rounded-xl border shadow-sm overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="text-left px-4 py-3 font-semibold text-gray-600">ID</th>
                    <th class="text-left px-4 py-3 font-semibold text-gray-600">Nombre</th>
                    <th class="text-left px-4 py-3 font-semibold text-gray-600">Rol</th>
                    <th class="text-left px-4 py-3 font-semibold text-gray-600">Estatus</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach ($users as $user)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-3 text-gray-500">{{ $user->id }}</td>
                    <td class="px-4 py-3 font-medium text-gray-800">{{ $user->person->names }} {{ $user->person->surnames }}</td>
                    <td class="px-4 py-3">
                        <span class="bg-gray-100 text-gray-700 text-xs font-semibold px-2 py-1 rounded-full">{{ $user->role->name }}</span>
                    </td>
                    <td class="px-4 py-3">
                        <span class="text-xs font-semibold px-2 py-1 rounded-full {{ $user->status->name === 'Activo' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-600' }}">
                            {{ $user->status->name }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
