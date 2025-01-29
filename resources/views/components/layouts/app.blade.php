<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="fi min-h-screen">
@php
    use App\Helpers\SiteConfig;
    $config = SiteConfig::get();
    // dd($config['title']);
    $links = [
        ['label' => 'Home', 'href' => 'home'],
        ['label' => 'Portfolio', 'href' => 'portfolio'],
        ['label' => 'Blogs', 'href' => 'blogs'],
    ];
    $title = $config['title'] ?? config('app.name');
    $currentUrl = request()->url();
@endphp

<head>
    <meta charset="utf-8">

    <meta name="application-name" content="{{ config('app.name') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ url($config['icon']) }}" >

    <title>{{ $title }}</title>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    @vite('resources/css/app.css')
    @filamentStyles
</head>

<body class="antialiased">
    @livewire('notifications')
    <header>
        @livewire('navbar')
        {{-- <nav class="flex justify-between p-4 py-3">
            <div>
                <a href="{{ route('home') }}" class="text-2xl font-bold hover:cursor-pointer">
                    {{ $title }}
                </a>
            </div>
            <div class="flex gap-3">
                <ul class="flex gap-3">
                    @foreach ($links as $link)
                        <li>
                            <a
                                tag="a"
                                class="fi-sidebar-item-button outline-none"
                                href="{{ route($link['href']) }}"
                            >
                                {{ $link['label'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </nav> --}}
    </header>
    <main class="p-4">
        {{ $slot }}
    </main>

    @filamentScripts
    @vite('resources/js/app.js')
</body>

</html>
