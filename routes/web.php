<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ThemeController;

Route::get('/', [ThemeController::class, 'index'])->name('home');

Route::post('/themes', [ThemeController::class, 'store'])->name('themes.store');

Route::post('/theme-switch', [ThemeController::class, 'switch'])->name('theme.switch');

Route::delete('/themes/{theme}', [ThemeController::class, 'destroy'])->name('themes.destroy');