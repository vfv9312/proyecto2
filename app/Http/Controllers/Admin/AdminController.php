<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use App\Models\User;
use App\Models\WeddingSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $section = 1;
        return view('pages.admin', compact('section'));
    }

    public function create()
    {
        $section = 2;
        return view('pages.admin', compact('section'));
    }

    public function store(Request $request)
    {
        //
    }

    public function show(User $user)
    {
        $section = 3;
        return view('pages.admin', compact('section', 'user'));
    }

    public function edit(User $user)
    {
        $section = 4;
        return view('pages.admin', compact('section', 'user'));
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function dashboard()
    {
        if (!Auth::check()) return redirect()->route('login');
        $section = 5;
        return view('pages.admin', compact('section'));
    }

    /**
     * Wedding: Lista y CRUD de invitados
     */
    public function guests()
    {
        $section = 6;
        return view('pages.admin', compact('section'));
    }

    /**
     * Wedding: Configuración general
     */
    public function settings()
    {
        $section = 7;
        return view('pages.admin', compact('section'));
    }

    /**
     * Wedding: Ver confirmaciones
     */
    public function confirmations()
    {
        $section = 8;
        return view('pages.admin', compact('section'));
    }

    public function destroy(string $id)
    {
        //
    }
}
