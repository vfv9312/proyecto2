<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Gallery extends Component
{
    use WithFileUploads;

    public $new_photos = [];
    public $successMessage = '';

    public function updatedNewPhotos()
    {
        $this->validate([
            'new_photos.*' => 'image|max:10240', // 10MB Max per photo
        ]);

        foreach ($this->new_photos as $photo) {
            $photo->store('gallery', 'public');
        }

        $this->successMessage = count($this->new_photos) . ' fotos subidas exitosamente!';
        $this->new_photos = [];
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
