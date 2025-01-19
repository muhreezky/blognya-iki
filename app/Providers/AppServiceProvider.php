<?php

namespace App\Providers;

use Filament\Navigation\MenuItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Session;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // dd($lang);
        Model::unguard();
        filament()->serving(function () {
            $lang = Session::get('lang', 'en');
            filament()->registerUserMenuItems([
                MenuItem::make()
                    ->label('Language / Bahasa')
                    ->icon('heroicon-s-language')
                    ->url(route('set-lang', ['lang' => $lang === 'en' ? 'id' : 'en']))
            ]);
        });
    }
}
