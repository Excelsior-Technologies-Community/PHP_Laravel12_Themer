<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Theme;

class ThemeSeeder extends Seeder
{
    public function run(): void
    {
        Theme::create([
            'name' => 'Light',
            'slug' => 'light',
            'primary_color' => '#ffffff',
            'secondary_color' => '#f0f0f0',
        ]);

        Theme::create([
            'name' => 'Dark',
            'slug' => 'dark',
            'primary_color' => '#1f2937',
            'secondary_color' => '#111827',
        ]);
    }
}