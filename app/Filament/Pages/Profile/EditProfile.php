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
            Components\Tabs::make()->schema([
                Components\Tabs\Tab::make('Pendidikan')
                    ->schema([
                        Components\Repeater::make('educationHistories')
                            ->required()
                            ->relationship()->label('Riwayat Pendidikan')
                            ->schema([
                                Components\TextInput::make('institution')
                                    ->label('Nama Institusi')
                                    ->required()->maxLength(255),
                                Components\TextInput::make('major')->required()->maxLength(255)
                                    ->label('Jurusan'),
                                Components\TextInput::make('degree')->required()->maxLength(255)
                                    ->label('Gelar / Jenjang Pendidikan'),
                                Components\Textarea::make('description')
                                    ->required()->maxLength(400),
                                Components\Fieldset::make()
                                    ->schema([
                                        Components\Select::make('start_month')->required()->options(
                                            function() {
                                                $arr = [];
                                                for($i = 0; $i < 12; $i++) {
                                                    $arr[(string) $i] = __("times/months.{$i}");
                                                }
                                                return $arr;
                                            }
                                        )->native(false),
                                        Components\TextInput::make('start_year')->required()
                                            ->numeric()->default(now()->year)
                                    ]),
                                Components\Fieldset::make()
                                    ->schema([
                                        Components\Select::make('end_month')->required()->options(
                                            function() {
                                                $arr = [];
                                                for($i = 0; $i < 12; $i++) {
                                                    $arr[(string) $i] = __("times/months.{$i}");
                                                }
                                                return $arr;
                                            }
                                        )->native(false)
                                        ->rules([
                                            fn ($get) => function ($attribute, $value, $fail) use ($get) {
                                                $month = (int) $get('start_month');
                                                $startYear = (int) $get('start_year');
                                                $year = (int) $get('end_year');
                                                if (($month > $value) && ($startYear >= $year)) {
                                                    $fail('You can\'t set earlier than starting month and date');
                                                }
                                            }
                                        ]),
                                        Components\TextInput::make('end_year')
                                            ->required()->label('End year (or expected)')
                                            ->numeric()->default(now()->year)
                                            ->rules([
                                                fn ($get) => function ($attribute, $value, $fail) use ($get) {
                                                    $year = $get('start_year');
                                                    if ($year > $value) {
                                                        $fail('End year can\'t be earlier than start year');
                                                    }
                                                }
                                            ])
                                    ]),
                            ])
                    ])
            ])
        ]);
    }
}
