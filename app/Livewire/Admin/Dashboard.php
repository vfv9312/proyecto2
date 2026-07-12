<?php

namespace App\Livewire\Admin;

use App\Models\Guest;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $total       = Guest::count();
        $confirmed   = Guest::where('confirmed', true)->count();
        $declined    = Guest::where('confirmed', false)->whereNotNull('confirmed_tickets')->count();
        $pending     = $total - $confirmed - $declined;
        $clabeClicks = Guest::sum('clabe_clicks');

        // Top 5 invitados con más clicks en CLABE
        $topClabe = Guest::where('clabe_clicks', '>', 0)
            ->orderByDesc('clabe_clicks')
            ->limit(5)
            ->get(['name', 'clabe_clicks']);

        // Total pases confirmados vs asignados
        $totalTickets    = Guest::sum('tickets');
        $confirmedTickets = Guest::where('confirmed', true)->sum('confirmed_tickets');

        return view('livewire.admin.dashboard', compact(
            'total', 'confirmed', 'declined', 'pending',
            'clabeClicks', 'topClabe',
            'totalTickets', 'confirmedTickets'
        ));
    }
}
