<div>
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

    <div class="p-6 space-y-8">

        <!-- ── Tarjetas resumen ── -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-5 flex flex-col items-center border-t-4 border-[#556B2F]">
                <span class="text-3xl font-black text-[#556B2F]">{{ $total }}</span>
                <span class="text-xs text-gray-500 mt-1 uppercase tracking-widest">Total invitados</span>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-5 flex flex-col items-center border-t-4 border-emerald-500">
                <span class="text-3xl font-black text-emerald-500">{{ $confirmed }}</span>
                <span class="text-xs text-gray-500 mt-1 uppercase tracking-widest">Sí asistirán</span>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-5 flex flex-col items-center border-t-4 border-red-400">
                <span class="text-3xl font-black text-red-400">{{ $declined }}</span>
                <span class="text-xs text-gray-500 mt-1 uppercase tracking-widest">No asistirán</span>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-5 flex flex-col items-center border-t-4 border-amber-400">
                <span class="text-3xl font-black text-amber-400">{{ $pending }}</span>
                <span class="text-xs text-gray-500 mt-1 uppercase tracking-widest">Sin respuesta</span>
            </div>
        </div>

        <!-- ── Fila de gráficas ── -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Gráfica donut – Confirmación de asistencia -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-6">
                <h3 class="text-sm font-bold text-gray-700 dark:text-gray-200 uppercase tracking-widest mb-4">
                    ✅ Confirmación de Asistencia
                </h3>
                <div class="relative" style="height:260px">
                    <canvas id="rsvpChart"></canvas>
                </div>
                <div class="flex justify-center gap-6 mt-4 text-xs text-gray-500">
                    <span class="flex items-center gap-1"><span class="w-3 h-3 rounded-full bg-emerald-500 inline-block"></span> Sí ({{ $confirmed }})</span>
                    <span class="flex items-center gap-1"><span class="w-3 h-3 rounded-full bg-red-400 inline-block"></span> No ({{ $declined }})</span>
                    <span class="flex items-center gap-1"><span class="w-3 h-3 rounded-full bg-amber-300 inline-block"></span> Pendiente ({{ $pending }})</span>
                </div>
            </div>

            <!-- Gráfica barras – Pases confirmados vs asignados -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-6">
                <h3 class="text-sm font-bold text-gray-700 dark:text-gray-200 uppercase tracking-widest mb-4">
                    🎟️ Pases Asignados vs Confirmados
                </h3>
                <div class="relative" style="height:260px">
                    <canvas id="ticketsChart"></canvas>
                </div>
            </div>

        </div>

        <!-- ── Gráfica clicks CLABE ── -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-bold text-gray-700 dark:text-gray-200 uppercase tracking-widest">
                    💳 Clicks en "Copiar CLABE"
                </h3>
                <span class="bg-[#556B2F]/10 text-[#556B2F] text-sm font-bold px-3 py-1 rounded-full">
                    Total: {{ $clabeClicks }}
                </span>
            </div>

            @if($clabeClicks > 0)
                <div class="relative" style="height:220px">
                    <canvas id="clabeChart"></canvas>
                </div>
            @else
                <div class="text-center py-10 text-gray-400">
                    <svg class="w-12 h-12 mx-auto mb-3 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <p class="text-sm italic">Aún ningún invitado ha copiado la CLABE.</p>
                </div>
            @endif
        </div>

    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {

        // ── Donut RSVP ──
        const rsvpCtx = document.getElementById('rsvpChart');
        if (rsvpCtx) {
            new Chart(rsvpCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Sí asistirán', 'No asistirán', 'Sin respuesta'],
                    datasets: [{
                        data: [{{ $confirmed }}, {{ $declined }}, {{ $pending }}],
                        backgroundColor: ['#10b981', '#f87171', '#fcd34d'],
                        borderWidth: 0,
                        hoverOffset: 8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '65%',
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            callbacks: {
                                label: ctx => ` ${ctx.parsed} invitados`
                            }
                        }
                    }
                }
            });
        }

        // ── Barras pases ──
        const ticketsCtx = document.getElementById('ticketsChart');
        if (ticketsCtx) {
            new Chart(ticketsCtx, {
                type: 'bar',
                data: {
                    labels: ['Pases Totales', 'Pases Confirmados'],
                    datasets: [{
                        label: 'Pases',
                        data: [{{ $totalTickets }}, {{ $confirmedTickets }}],
                        backgroundColor: ['rgba(85,107,47,0.25)', 'rgba(16,185,129,0.7)'],
                        borderColor: ['#556B2F', '#10b981'],
                        borderWidth: 2,
                        borderRadius: 10,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { precision: 0 },
                            grid: { color: 'rgba(0,0,0,0.05)' }
                        },
                        x: { grid: { display: false } }
                    }
                }
            });
        }

        // ── Barras CLABE clicks ──
        const clabeCtx = document.getElementById('clabeChart');
        if (clabeCtx) {
            const clabeLabels = @json($topClabe->pluck('name'));
            const clabeData   = @json($topClabe->pluck('clabe_clicks'));

            new Chart(clabeCtx, {
                type: 'bar',
                data: {
                    labels: clabeLabels,
                    datasets: [{
                        label: 'Clicks',
                        data: clabeData,
                        backgroundColor: 'rgba(85,107,47,0.7)',
                        borderColor: '#556B2F',
                        borderWidth: 2,
                        borderRadius: 10,
                    }]
                },
                options: {
                    indexAxis: 'y',
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        x: {
                            beginAtZero: true,
                            ticks: { precision: 0 },
                            grid: { color: 'rgba(0,0,0,0.05)' }
                        },
                        y: { grid: { display: false } }
                    }
                }
            });
        }
    });
    </script>
</div>
