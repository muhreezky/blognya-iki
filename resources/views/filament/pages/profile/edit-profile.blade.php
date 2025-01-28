@php
    /**
     * @var App\Filament\Pages\Profile\EditProfile $this
     * */
@endphp
<x-filament-panels::page>
    <x-filament-panels::form id="form" wire:submit="save">
        {{ $this->form }}
        <x-filament::button type="submit">
            {{ __('form/actions.save') }}
        </x-filament::button>
    </x-filament-panels::form>
</x-filament-panels::page>
