<?php

namespace App\Livewire\Dashboard;

use App\Models\Guest;
use Livewire\Component;

class Invitation extends Component
{
    public Guest $guest;
    public array $settings = [];

    // RSVP form
    public string $rsvp_name = '';
    public int $rsvp_tickets = 1;
    public bool $rsvp_attending = true;
    public bool $rsvp_submitted = false;

    public function mount(Guest $guest, array $settings = [])
    {
        $this->guest    = $guest;
        $this->settings = $settings;
        $this->rsvp_name    = $guest->name;
        $this->rsvp_tickets = $guest->tickets;
        // Si ya confirmó, mostramos directamente el mensaje de confirmado
        $this->rsvp_submitted = $guest->confirmed;
    }

    public function confirmRsvp()
    {
        $this->validate([
            'rsvp_name'    => 'required|string|max:255',
            'rsvp_tickets' => 'required|integer|min:1',
        ]);

        $this->guest->update([
            'confirmed'         => $this->rsvp_attending,
            'confirmed_tickets' => $this->rsvp_attending ? $this->rsvp_tickets : 0,
        ]);

        $this->rsvp_submitted = true;
    }

    public function render()
    {
        return view('livewire.dashboard.invitation', [
            'guest'    => $this->guest,
            'settings' => $this->settings,
        ]);
    }
}
