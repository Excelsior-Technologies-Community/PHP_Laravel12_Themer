<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ThemeController;

Route::get('/', [ThemeController::class, 'index'])->name('home');
Route::post('/theme-switch', [ThemeController::class, 'switch'])->name('theme.switch');

