<?php

namespace Database\Seeders;

use App\Models\WeddingSetting;
use Illuminate\Database\Seeder;

class WeddingSettingSeeder extends Seeder
{
    public function run(): void
    {
        $defaults = [
            'groom_name'        => 'Vladimir',
            'bride_name'        => 'Yuri',
            'wedding_date'      => '2026-12-18',
            'wedding_date_text' => '18 de Diciembre, 2026',
            'ceremony_time'     => '15:00',
            'ceremony_place'    => 'Parroquia de San Miguel Arcángel',
            'ceremony_address'  => 'Calle Principal #123, Centro.',
            'ceremony_map_url'  => 'https://maps.google.com',
            'reception_time'    => '17:00',
            'reception_place'   => 'Jardín Los Encinos',
            'reception_address' => 'Km 15 Carretera al Bosque.',
            'reception_map_url' => 'https://maps.google.com',
            'bank_name'         => 'BBVA',
            'bank_holder'       => 'Vladimir y Yuri',
            'bank_clabe'        => '0123 4567 8901 2345 67',
            'music_url'         => 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3',
            'hero_image_url'    => 'https://images.unsplash.com/photo-1519225421980-715cb0215aed?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80',
        ];

        foreach ($defaults as $key => $value) {
            WeddingSetting::set($key, $value);
        }
    }
}
