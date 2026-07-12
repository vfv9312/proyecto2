<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\WeddingSetting;
use Illuminate\Http\Request;

class DashBoardController extends Controller
{
    public function home()
    {
        $section = 1;
        $guest = null;
        $settings = $this->getSettings();
        return view('pages.dashboard', compact('section', 'guest', 'settings'));
    }

    public function gallery()
    {
        $section = 2;
        return view('pages.dashboard', compact('section'));
    }

    public function invitation(string $slug)
    {
        $guest = Guest::where('slug', $slug)->firstOrFail();
        session(['guest_slug' => $slug]);
        $settings = $this->getSettings();
        $section = 3;
        return view('pages.dashboard', compact('section', 'guest', 'settings'));
    }

    private function getSettings(): array
    {
        return WeddingSetting::pluck('value', 'key')->toArray();
    }
}
