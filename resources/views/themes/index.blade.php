<!DOCTYPE html>
<html lang="en" class="{{ session('theme', 'light') == 'dark' ? 'dark' : '' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Themer</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = { darkMode: 'class' }
    </script>
</head>

<body class="min-h-screen text-black dark:text-white" style="background: {{ session('secondary_color', '#f3f4f6') }}">
    <div class="max-w-6xl mx-auto px-6 py-10">

        <!-- HEADER -->
        <div class="text-center mb-10">

            <h1
                class="text-5xl font-extrabold bg-gradient-to-r from-indigo-500 to-purple-600 text-transparent bg-clip-text">
                Laravel Theme Switcher
            </h1>

            <p class="text-gray-500 dark:text-gray-400 mt-2">
                Modern Theme Management System
            </p>

        </div>

        <!-- SUCCESS -->
        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded-xl mb-6 shadow-lg">
                {{ session('success') }}
            </div>
        @endif

        <!-- CREATE BUTTON -->
        <div class="text-center mb-6">

            <button onclick="openModal()" style="background: {{ session('primary_color', '#4f46e5') }}"
                class="text-white px-6 py-3 rounded-xl shadow-lg transition">

                + Create Theme

            </button>

        </div>

        <!-- SEARCH -->
        <div class="bg-white dark:bg-gray-800 p-4 rounded-2xl shadow mb-6 flex gap-3">

            <form method="GET" class="flex w-full gap-3">

                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search themes..."
                    class="flex-1 p-3 rounded-xl border dark:border-gray-700 bg-gray-50 dark:bg-gray-900">

                <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 rounded-xl">
                    Search
                </button>

            </form>

        </div>

        <!-- SWITCH -->
        <div class="bg-white dark:bg-gray-800 p-5 rounded-2xl shadow mb-8">

            <form action="{{ route('theme.switch') }}" method="POST" class="flex gap-3">

                @csrf

                <select name="theme_id"
                    class="flex-1 p-3 rounded-xl border dark:border-gray-700 bg-gray-50 dark:bg-gray-900">

                    @foreach($themes as $theme)

                        <option value="{{ $theme->id }}" {{ session('theme', 'light') == $theme->slug ? 'selected' : '' }}>

                            {{ $theme->name }}

                        </option>

                    @endforeach

                </select>

                <button style="background: {{ session('primary_color', '#16a34a') }}"
                    class="text-white px-6 rounded-xl">
                    Switch
                </button>

            </form>

        </div>

        <!-- CARDS -->
        <div class="grid md:grid-cols-2 gap-6">

            @forelse($themes as $theme)

                <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-lg hover:shadow-2xl transition">

                    <div class="flex justify-between items-start">

                        <div>
                            <h2 class="text-2xl font-bold">{{ $theme->name }}</h2>
                            <p class="text-gray-500">{{ $theme->slug }}</p>
                        </div>

                        @if(session('theme', 'light') == $theme->slug)

                            <span class="bg-green-500 text-white text-xs px-3 py-1 rounded-full">
                                Active
                            </span>

                        @endif

                    </div>

                    <form action="{{ route('themes.destroy', $theme->id) }}" method="POST" class="mt-4"
                        onsubmit="return confirm('Are you sure you want to delete this theme?');">

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl">
                            Delete
                        </button>

                    </form>
                </div>

            @empty

                <p class="text-center col-span-2 text-gray-500">
                    No Themes Found
                </p>

            @endforelse

        </div>

        <!-- PAGINATION -->
        <div class="mt-8">
            {{ $themes->links() }}
        </div>

    </div>

    <!-- MODAL -->
    <div id="modal" class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center">

        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl w-full max-w-md relative shadow-2xl">

            <button onclick="closeModal()" class="absolute top-3 right-4 text-xl">
                ✖
            </button>

            <h2 class="text-2xl font-bold mb-4">Create Theme</h2>

            <form action="{{ route('themes.store') }}" method="POST" class="space-y-3">

                @csrf

                <input type="text" name="name" placeholder="Theme Name"
                    class="w-full p-3 rounded-xl border dark:border-gray-700 bg-gray-50 dark:bg-gray-900">

                <input type="text" name="slug" placeholder="Slug"
                    class="w-full p-3 rounded-xl border dark:border-gray-700 bg-gray-50 dark:bg-gray-900">

                <button class="w-full bg-gradient-to-r from-blue-500 to-indigo-600 text-white p-3 rounded-xl">
                    Create Theme
                </button>

            </form>

        </div>

    </div>

    <script>
        function openModal() {
            document.getElementById('modal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('modal').classList.add('hidden');
        }
    </script>

</body>

</html>