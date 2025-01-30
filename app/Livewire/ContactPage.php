<?php

namespace App\Livewire;

use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Concerns\InteractsWithFormActions;
use Livewire\Component;
use Filament\Forms\Components as Forms;
class ContactPage extends Component implements HasForms
{
    use InteractsWithForms, InteractsWithFormActions;
    public function render()
    {
        return view('livewire.contact-page');
    }

    public function mount()
    {
        $this->form->fill();
    }

    public function form(Form $form)
    {
        return $form->schema([
            Forms\TextInput::make('email')->required()->email()->label('Email Anda'),
            Forms\TextInput::make('subject')->required()->maxLength(255)->label('Judul'),
            Forms\Select::make('purpose')->required()->native(false)->options([
                'Pembuatan Website',
                'Layanan SEO',
                'Konsultasi Tugas',
                'Lainnya',
            ])->label('Tujuan'),
            Forms\RichEditor::make('content')->required()->disableToolbarButtons([
                'attachFiles',
            ])->label(''),
        ]);
    }

    public function save()
    {

    }
}
