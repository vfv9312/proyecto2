<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'tickets',
        'confirmed_tickets',
        'confirmed',
        'table_name',
        'seats',
        'video_url',
        'notes',
    ];

    protected $casts = [
        'confirmed' => 'boolean',
        'tickets' => 'integer',
        'confirmed_tickets' => 'integer',
    ];

    /**
     * Genera automáticamente el slug a partir del nombre.
     */
    public static function generateSlug(string $name): string
    {
        $base = Str::slug($name);
        $slug = $base;
        $count = 1;
        while (static::where('slug', $slug)->exists()) {
            $slug = $base . '-' . $count++;
        }
        return $slug;
    }

    /**
     * Obtiene la URL de video convertida a formato embed de YouTube si es necesario.
     */
    public function getEmbedVideoUrlAttribute(): ?string
    {
        if (!$this->video_url) {
            return null;
        }

        $url = $this->video_url;

        if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/|youtube\.com\/shorts\/)([^&\s\?]+)/', $url, $matches)) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }

        return $url;
    }
}

