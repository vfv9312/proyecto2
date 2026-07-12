<?php

namespace App\Livewire\Admin;

use App\Models\Guest;
use Livewire\Component;
use Livewire\WithPagination;

class Confirmations extends Component
{
    use WithPagination;

    public $search = '';
    public $filterConfirmed = '';

    public function updatedSearch() { $this->resetPage(); }
    public function updatedFilterConfirmed() { $this->resetPage(); }

    public function render()
    {
        $query = Guest::query()
            ->when($this->search, fn($q) => $q->where('name', 'like', '%'.$this->search.'%'))
            ->when($this->filterConfirmed !== '', fn($q) => $q->where('confirmed', (bool)$this->filterConfirmed));

        $guests = $query->latest()->paginate(20);

        $stats = [
            'total_guests'      => Guest::count(),
            'total_tickets'     => Guest::sum('tickets'),
            'confirmed_guests'  => Guest::where('confirmed', true)->count(),
            'confirmed_tickets' => Guest::where('confirmed', true)->sum('confirmed_tickets'),
            'pending_guests'    => Guest::where('confirmed', false)->count(),
        ];

        return view('livewire.admin.confirmations', compact('guests', 'stats'));
    }
}
