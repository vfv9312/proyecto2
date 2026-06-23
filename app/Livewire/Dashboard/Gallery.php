<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Gallery extends Component
{
    use WithFileUploads;

    public $photo;
    public $successMessage = '';

    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'image|max:5120', // 5MB Max
        ]);

        $this->photo->store('gallery', 'public');

        $this->successMessage = '¡Foto subida exitosamente!';
        $this->photo = null;
    }

    public function getPhotosProperty()
    {
        if (Storage::disk('public')->exists('gallery')) {
            $files = Storage::disk('public')->files('gallery');
            // Filter only images if needed and map to URLs
            return collect($files)->map(function ($file) {
                return Storage::url($file);
            })->reverse()->values()->all();
        }

        return [];
    }

    public function render()
    {
        return view('livewire.dashboard.gallery');
    }
}
