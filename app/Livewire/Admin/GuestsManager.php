<?php

namespace App\Livewire\Admin;

use App\Models\Guest;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class GuestsManager extends Component
{
    use WithPagination;

    // Form fields
    public $guestId = null;
    public $name = '';
    public $slug = '';
    public $tickets = 1;
    public $table_name = '';
    public $seats = '';
    public $video_url = '';
    public $notes = '';

    // UI state
    public $showForm = false;
    public $showDeleteModal = false;
    public $deleteId = null;
    public $search = '';

    protected $rules = [
        'name'      => 'required|string|max:255',
        'tickets'   => 'required|integer|min:1|max:20',
        'table_name'=> 'nullable|string|max:100',
        'seats'     => 'nullable|string|max:100',
        'video_url' => 'nullable|url|max:500',
        'notes'     => 'nullable|string|max:1000',
    ];

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function openCreate()
    {
        $this->reset(['guestId','name','slug','tickets','table_name','seats','video_url','notes']);
        $this->showForm = true;
    }

    public function openEdit(int $id)
    {
        $guest = Guest::findOrFail($id);
        $this->guestId   = $guest->id;
        $this->name      = $guest->name;
        $this->slug      = $guest->slug;
        $this->tickets   = $guest->tickets;
        $this->table_name = $guest->table_name;
        $this->seats     = $guest->seats;
        $this->video_url = $guest->video_url;
        $this->notes     = $guest->notes;
        $this->showForm  = true;
    }

    public function save()
    {
        $this->validate();

        $slug = $this->guestId
            ? $this->slug
            : Guest::generateSlug($this->name);

        Guest::updateOrCreate(
            ['id' => $this->guestId],
            [
                'name'       => $this->name,
                'slug'       => $slug,
                'tickets'    => $this->tickets,
                'table_name' => $this->table_name,
                'seats'      => $this->seats,
                'video_url'  => $this->video_url,
                'notes'      => $this->notes,
            ]
        );

        $this->showForm = false;
        $this->reset(['guestId','name','slug','tickets','table_name','seats','video_url','notes']);
        session()->flash('message', $this->guestId ? 'Invitado actualizado.' : 'Invitado creado.');
    }

    public function confirmDelete(int $id)
    {
        $this->deleteId = $id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        Guest::destroy($this->deleteId);
        $this->showDeleteModal = false;
        $this->deleteId = null;
        session()->flash('message', 'Invitado eliminado.');
    }

    public function getInvitationUrl(Guest $guest): string
    {
        return route('invitation', $guest->slug);
    }

    public function render()
    {
        $guests = Guest::where('name', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(15);

        $stats = [
            'total'     => Guest::count(),
            'tickets'   => Guest::sum('tickets'),
            'confirmed' => Guest::where('confirmed', true)->sum('confirmed_tickets'),
            'pending'   => Guest::where('confirmed', false)->count(),
        ];

        return view('livewire.admin.guests-manager', compact('guests', 'stats'));
    }
}
