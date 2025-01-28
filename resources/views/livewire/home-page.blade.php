@php
    use App\Helpers\SiteConfig;
    $config = SiteConfig::get();
@endphp
<div>
    <x-filament::card>
        <h1 class="text-3xl font-bold mb-4">{{ $config['tagline'] }}</h1>
        <div class="text-lg">{{ $config['description'] }}</div>
    </x-filament::card>
</div>
