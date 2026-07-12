<?php

namespace App\Livewire\Landing;

use Livewire\Component;

class Contact extends Component
{
    public $name;
    public $email;
    public $subject;
    public $message;
    public $success = false;

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email',
        'subject' => 'required|min:5',
        'message' => 'required|min:10',
    ];

    public function submit()
    {
        $this->validate();

        // Simulation of email sending...
        // Mail::to('admin@cybac.com')->send(new ContactForm($this->all()));

        $this->success = true;
        
        // Reset form
        $this->reset(['name', 'email', 'subject', 'message']);
    }

    public function render()
    {
        return view('livewire.landing.contact');
    }
}
