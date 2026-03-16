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