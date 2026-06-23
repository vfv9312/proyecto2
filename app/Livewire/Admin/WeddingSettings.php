<?php

namespace App\Livewire\Admin;

use App\Models\WeddingSetting;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class WeddingSettings extends Component
{
    use WithFileUploads;

    public $groom_name = '';
    public $bride_name = '';
    public $wedding_date_text = '';
    public $ceremony_time = '';
    public $ceremony_place = '';
    public $ceremony_address = '';
    public $ceremony_map_url = '';
    public $reception_time = '';
    public $reception_place = '';
    public $reception_address = '';
    public $reception_map_url = '';
    public $bank_name = '';
    public $bank_holder = '';
    public $bank_clabe = '';
    public $music_url = '';
    public $hero_image_url = '';

    // File uploads
    public $music_file;
    public $hero_image_file;

    public function mount()
    {
        $keys = [
            'groom_name','bride_name','wedding_date_text',
            'ceremony_time','ceremony_place','ceremony_address','ceremony_map_url',
            'reception_time','reception_place','reception_address','reception_map_url',
            'bank_name','bank_holder','bank_clabe','music_url','hero_image_url',
        ];
        foreach ($keys as $key) {
            $this->$key = WeddingSetting::get($key, '');
        }
    }

    public function save()
    {
        $this->validate([
            'music_file' => 'nullable|file|mimes:mp3,wav,ogg,mpga,mpeg|max:20480', // 20MB
            'hero_image_file' => 'nullable|image|max:10240', // 10MB
        ]);

        if ($this->music_file) {
            $path = $this->music_file->store('wedding', 'public');
            $this->music_url = Storage::url($path);
            $this->music_file = null;
        }

        if ($this->hero_image_file) {
            $path = $this->hero_image_file->store('wedding', 'public');
            $this->hero_image_url = Storage::url($path);
            $this->hero_image_file = null;
        }

        $keys = [
            'groom_name','bride_name','wedding_date_text',
            'ceremony_time','ceremony_place','ceremony_address','ceremony_map_url',
            'reception_time','reception_place','reception_address','reception_map_url',
            'bank_name','bank_holder','bank_clabe','music_url','hero_image_url',
        ];
        foreach ($keys as $key) {
            WeddingSetting::set($key, $this->$key);
        }
        session()->flash('message', 'Configuración guardada exitosamente.');
    }

    public function render()
    {
        return view('livewire.admin.wedding-settings');
    }
}

