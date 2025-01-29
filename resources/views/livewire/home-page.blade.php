@php
    use App\Helpers\SiteConfig;
    $config = SiteConfig::get();
@endphp
<div>
    <x-filament::card>
        <div class="text-center">
            <h1 class="text-4xl font-bold mb-4">{{ $config['tagline'] }}</h1>
            <div class="text-2xl mb-6">{{ $config['description'] }}</div>
            <x-filament::button tag="a" class="end">
                Get Started
            </x-filament::button>
        </div>
    </x-filament::card>
</div>
