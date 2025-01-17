<x-filament-panels::page>
    {{-- @livewire('notifications') --}}
    <x-filament-panels::form id="form" wire:submit="save">
        {{ $this->form }}

        {{-- <x-filament-panels::form.actions
          :actions="$this->getCachedFormActions()"
          :full-width="$this->hasFullWidthFormActions()"
      /> --}}
        <x-filament::button type="submit">
            {{ __('form/actions.save') }}
        </x-filament::button>
    </x-filament-panels::form>
</x-filament-panels::page>
