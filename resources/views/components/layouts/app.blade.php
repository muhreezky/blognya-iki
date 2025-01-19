<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@php
    $links = [
        ['label' => 'Home', 'href' => 'home'],
        ['label' => 'Blogs', 'href' => 'blogs']
    ];
@endphp

<head>
    <meta charset="utf-8">

    <meta name="application-name" content="{{ config('app.name') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    @filamentStyles
    @vite('resources/css/app.css')
</head>

<body class="antialiased">
    <header>
        <nav class="flex justify-between p-4 py-3">
            <div>
                <a href="{{ route('home') }}" class="text-2xl font-bold hover:cursor-pointer">
                    {{ config('app.name') }}
                </a>
            </div>
            <div class="flex gap-3">
                <ul class="flex gap-3">
                    @foreach ($links as $link)
                        <li>
                            <x-filament::button tag="a" href="{{ route($link['href']) }}" outlined>
                                {{ $link['label'] }}
                            </x-filament::button>
                        </li>
                    @endforeach
                </ul>
            </div>
        </nav>
    </header>
    <main class="p-4">
        {{ $slot }}
    </main>

    @filamentScripts
    @vite('resources/js/app.js')
</body>

</html>
