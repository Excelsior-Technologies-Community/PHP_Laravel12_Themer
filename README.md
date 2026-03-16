# PHP_Laravel12_Themer

## Introduction

PHP_Laravel12_Themer is a Laravel 12 project designed to demonstrate dynamic theme switching in web applications. With this project, users can seamlessly switch between multiple themes—such as light, dark, or custom themes—and see the interface update instantly. The project leverages Laravel’s powerful backend, sessions, and Tailwind CSS for a modern, responsive, and visually appealing UI. 

---

## Project Overview

The PHP_Laravel12_Themer project includes the following key features:

#### 1) Theme Management:

- Supports multiple pre-defined themes (light, dark, custom).

- Themes are stored in the database with attributes like primary_color and secondary_color.


#### 2) Dynamic Switching:

- Users can select a theme from a dropdown menu.

- The UI updates immediately without page reloads using Laravel sessions.


#### 3) Responsive Design:

- Built with Tailwind CSS for a modern, responsive layout.

- Dark mode is fully supported, ensuring seamless transitions between themes.


#### 4) Database Integration:

- Themes are managed via Laravel migrations and seeders.

- Easy to extend with additional themes or color schemes.


#### 5) Clean Project Structure:

- Follows standard Laravel conventions.

- Includes MVC structure with models, controllers, and Blade views.


#### 6) Preview Section:

- Users can preview their selected theme with dynamic cards demonstrating background and text color changes.


#### 7) Customizability:

- Developers can easily extend the project to include user-specific theme preferences, more theme options, or advanced color palettes.

---

## Requirements

- PHP >= 8.1  
- Laravel 12  
- Composer  
- Node.js & NPM (for frontend assets)  
- MySQL (or any database supported by Laravel)

---

## Step 1: Create Laravel 12 Project

Open your terminal and run:

```bash
composer create-project laravel/laravel PHP_Laravel12_Themer "12.*"
```
Go into the project directory:

```bash
cd PHP_Laravel12_Themer
```
---

## Step 2: Set Up Database

Update .env file with your database details:

```.env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel12_themer
DB_USERNAME=root
DB_PASSWORD=
```
Then Run Migration Command:

```bash
php artisan migrate
```
---

## Step 3: Create Migration and Model for Themes

Run Artisan commands:

```bash
php artisan make:model Theme -m
```

This creates:

- app/Models/Theme.php

- database/migrations/xxxx_xx_xx_create_themes_table.php


### Update migration file:

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('themes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // e.g., Light, Dark
            $table->string('slug')->unique(); // e.g., light, dark
            $table->string('primary_color')->nullable();
            $table->string('secondary_color')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('themes');
    }
};
```

Run migration:

```bash
php artisan migrate
```

### Model

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use HasFactory;

    // Fillable fields allow mass assignment
    protected $fillable = [
        'name',
        'slug',
        'primary_color',
        'secondary_color',
    ];

    /**
     * Optional: You can add helper methods here
     * Example: Check if this theme is active in session
     */
    public function isActive(): bool
    {
        return session('theme') === $this->slug;
    }
}
```

---

## Step 4: Seed Some Themes

Create a seeder:

```bash
php artisan make:seeder ThemeSeeder
```

Edit database/seeders/ThemeSeeder.php:

```php
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
```
Run the seeder:

```bash
php artisan db:seed --class=ThemeSeeder
```

---

## Step 5: Create ThemeController

```bash
php artisan make:controller ThemeController
```
Edit app/Http/Controllers/ThemeController.php:

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Theme;
use Illuminate\Support\Facades\Session;

class ThemeController extends Controller
{
    public function index()
    {
        $themes = Theme::all();
       return view('themes', compact('themes'));
    }

    public function switch(Request $request)
    {
        $theme = Theme::findOrFail($request->theme_id);
        Session::put('theme', $theme->slug);
        return redirect()->back();
    }
}
```

---

## Step 6: Add Routes

Edit routes/web.php:

```php
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ThemeController;

Route::get('/', [ThemeController::class, 'index'])->name('home');
Route::post('/theme-switch', [ThemeController::class, 'switch'])->name('theme.switch');
```

---

## Step 7: Create Views

resources/views/themes.blade.php

```blade
<!DOCTYPE html>
<html lang="en" class="{{ session('theme') == 'dark' ? 'dark' : '' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Laravel Themer</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            darkMode: 'class'
        }
    </script>

    <style>
        body,
        .theme-card {
            transition: all .4s ease;
        }
    </style>

</head>

<body class="min-h-screen flex items-center justify-center
bg-gray-100 text-gray-900
dark:bg-gray-900 dark:text-gray-200">

    <div class="w-full max-w-4xl px-6 space-y-8">

        <!-- Header -->
        <header class="text-center space-y-2">

            <h1 class="text-5xl font-extrabold">
                Laravel Theme Switcher
            </h1>

            <p class="text-gray-500 dark:text-gray-400 text-lg">
                Switch themes dynamically and see your UI update instantly
            </p>

        </header>


        <!-- Theme Switcher -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8">

            <form action="{{ route('theme.switch') }}" method="POST"
                class="flex flex-col sm:flex-row gap-4">

                @csrf

                <select name="theme_id"
                    class="flex-1 px-4 py-3 rounded-xl border
border-gray-300 dark:border-gray-600
bg-gray-50 dark:bg-gray-700
text-gray-800 dark:text-gray-200">

                    @foreach($themes as $theme)

                    <option value="{{ $theme->id }}"
                        {{ session('theme') == $theme->slug ? 'selected' : '' }}>

                        {{ $theme->name }}

                    </option>

                    @endforeach

                </select>

                <button type="submit"
                    class="px-6 py-3 rounded-xl font-semibold text-white
bg-gradient-to-r from-blue-500 to-indigo-600
hover:from-indigo-600 hover:to-blue-500
shadow-lg hover:shadow-xl
transition duration-300">

                    Switch Theme

                </button>

            </form>

        </div>


        <!-- Preview Section -->
        <div class="bg-gray-50 dark:bg-gray-800 rounded-2xl shadow-inner p-8">

            <h2 class="text-3xl font-bold mb-4">
                Preview Your Theme
            </h2>

            <p class="text-lg mb-6 text-gray-600 dark:text-gray-400">
                Your selected theme will automatically update UI components.
            </p>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                <!-- Card -->
                <div class="theme-card p-5 rounded-xl shadow-md
bg-white dark:bg-gray-900">

                    <h3 class="font-semibold text-xl mb-2">
                        Card One
                    </h3>

                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        Dynamic background and text colors adapt to your theme.
                    </p>

                </div>


                <!-- Card -->
                <div class="theme-card p-5 rounded-xl shadow-md
bg-white dark:bg-gray-900">

                    <h3 class="font-semibold text-xl mb-2">
                        Card Two
                    </h3>

                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        Modern 2026 SaaS interface powered by Tailwind CSS.
                    </p>

                </div>

            </div>

        </div>


        <!-- Footer -->
        <footer class="text-center text-gray-400 text-sm pt-4">

            © {{ date('Y') }} Laravel Themer

        </footer>

    </div>

</body>

</html>
```
---

## Step 8: Test the Project

Start the server:

```bash
php artisan serve
```

Visit:

```bash
http://127.0.0.1:8000
```

- Select a theme from the dropdown and click Switch Theme

- The page should change colors based on the selected theme

---

## Output

<img src="screenshots/Screenshot 2026-03-16 133014.png" width="1000">
 
<img src="screenshots/Screenshot 2026-03-16 133028.png" width="1000">
 
---

## Project Structure

```
PHP_Laravel12_Themer/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── ThemeController.php
│   └── Models/
│       └── Theme.php
├── database/
│   ├── migrations/
│   │   └── xxxx_create_themes_table.php
│   └── seeders/
│       └── ThemeSeeder.php
├── resources/
│   └── views/
│       └── themes.blade.php
├── routes/
│   └── web.php
├── .env
├── composer.json
└── README.md
```

---

Your PHP_Laravel12_Themer Project is now ready!

