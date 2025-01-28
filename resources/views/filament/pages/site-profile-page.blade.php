@php
    /**
     * @var App\Filament\Pages\SiteProfilePage $this
     * */
@endphp
<x-filament-panels::page>
    <x-filament-panels::form wire:submit='save'>
        {{ $this->form }}
        <x-filament::button type="submit">{{ __('form/actions.save') }}</x-filament::button>
    </x-filament-panels::form>
    <x-filament-actions::modals />
</x-filament-panels::page>
