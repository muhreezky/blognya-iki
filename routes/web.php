<?php

use App\Livewire\BlogsPage;
use App\Livewire\HomePage;
use App\Livewire\PortfolioPage;
use Illuminate\Support\Facades\Route;

Route::name('home')->get('/', HomePage::class);

Route::get('storage/{name}', function ($name) {
    $disk = Storage::disk('public');
    $exists = $disk->exists($name);
    if (!$exists) return response()->json(['message' => 'File not found'], 404);
    $file = $disk->get($name);
    return response()->file($file, [
        'Access-Control-Allow-Origin' => '*',
        'Access-Control-Allow-Methods' => 'GET, OPTIONS',
        'Access-Control-Allow-Headers' => 'Content-Type, Authorization',
    ]);
})->where('name', '.*');

Route::get('/locale/{lang}', function ($lang) {
    Session::put('lang', $lang);
    app()->setLocale($lang);
    return redirect()->back();
})->name('set-lang');

Route::name('blogs')->get('/blogs', BlogsPage::class);
Route::name('portfolio')->get('/portfolio', PortfolioPage::class);
