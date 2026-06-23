@extends('layouts.landing-page')
@section('content')
    @switch($section)
        @case(1)
            @livewire('dashboard.home')
            @break
        @case(2)
            @livewire('dashboard.gallery')
            @break
        @case(3)
            @livewire('dashboard.invitation', ['guest' => $guest, 'settings' => $settings ?? []])
            @break
        @default
    @endswitch
@endsection