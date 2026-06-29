<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Theme;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        View::composer('*', function ($view) {
            if (Auth::check() && Auth::user()->theme_id) {
                $theme = Theme::find(Auth::user()->theme_id);
                if ($theme) {
                    session([
                        'theme' => $theme->slug,
                        'primary_color' => $theme->primary_color,
                        'secondary_color' => $theme->secondary_color,
                    ]);
                }
            }

            if (!session()->has('theme')) {
                session([
                    'theme' => 'light',
                    'primary_color' => '#4f46e5',
                    'secondary_color' => '#f43f5e',
                ]);
            }
        });
    }
}