@php
    use App\Livewire\ContactPage;
    /**
     * @var ContactPage $this
     * */
@endphp
<div>
    <x-filament::card>
        <form wire:submit='save'>
            {{ $this->form }}
            <x-filament::button class="w-full mt-6" type="submit">{{ __('form/actions.save') }}</x-filament::button>
        </form>
    </x-filament::card>
</div>
