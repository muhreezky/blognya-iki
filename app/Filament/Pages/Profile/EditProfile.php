<?php

namespace App\Filament\Pages\Profile;

use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Forms\Components;
use Hash;

class EditProfile extends \Filament\Pages\Auth\EditProfile
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.profile.edit-profile';

    protected function mutateFormDataBeforeSave(array $data): array
    {
        unset($data['old_password']);
        if ($data['password'] === null) {
            unset($data['password']);
        }
        return $data;
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['confirmed'] = false;
        return $data;
    }

    public function form(\Filament\Forms\Form $form): \Filament\Forms\Form
    {
        return $form->schema([
            Components\Section::make('Akun')->schema([
                Components\TextInput::make('name')->required(),
                Components\TextInput::make('email')->required(),
                Components\Actions::make([
                    Components\Actions\Action::make('Edit Password')->form([
                        Components\TextInput::make('current_password')->required()
                            ->password()->revealable(),
                        Components\TextInput::make('password')->required()->password()->revealable()
                            ->label('New Password'),
                    ])->action(function ($data) {
                        $check = Hash::check($data['current_password'], auth()->user()->getAuthPassword());
                        if (!$check) {
                            return Notification::make()
                                ->title('Fail')
                                ->danger()
                                ->body('Enter your old password correctly')
                                ->send();
                        }
                        auth()->user()->update(['password' => $data['password']]);
                        return Notification::make()
                            ->title('Success')
                            ->body('Password Updated')
                            ->success()
                            ->send();
                    }),
                ]),
            ]),
        ]);
    }
}
