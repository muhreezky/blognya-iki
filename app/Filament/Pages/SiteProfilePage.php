<?php

namespace App\Filament\Pages;

use App\Helpers\SiteConfig;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Concerns\InteractsWithFormActions;
use Filament\Pages\Page;
use Filament\Forms\Components;
use File;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class SiteProfilePage extends Page implements HasForms
{
    use InteractsWithForms, InteractsWithFormActions;
    protected static ?string $navigationIcon = 'heroicon-o-cog';

    protected static string $view = 'filament.pages.site-profile-page';
    protected static ?string $navigationGroup = 'Website';

    public array $data = [];

    public function getTitle(): string|\Illuminate\Contracts\Support\Htmlable
    {
        return __('pages/site-profile-page.title');
    }

    public static function getNavigationLabel(): string
    {
        return __('pages/site-profile-page.navlabel');
    }

    public function getForms(): array
    {
        return ['form'];
    }

    public function mount()
    {
        $json = SiteConfig::get();
        $this->form->fill($json);
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Components\TextInput::make('title')->required(),
            Components\TextInput::make('tagline')->required(),
            Components\Textarea::make('description')->required(),
            Components\FileUpload::make('icon')->required()->image()->imageEditor()
                ->disk('html_public')->preserveFilenames()
                ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file) {
                    $extension = $file->getClientOriginalExtension();
                    return "favicon.$extension";
                })
        ])->statePath('data');
    }

    public function save()
    {
        // $path = resource_path('metadata.json');
        $state = $this->form->getState();
        // dd($state);
        // File::put($path, json_encode($state));
        SiteConfig::save($state);
        Notification::make()->success()->title('Success')
            ->body('Site Configuration Changed')->send();
        // redirect(request()->url());
    }
}
