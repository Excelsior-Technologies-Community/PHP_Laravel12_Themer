<div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-lg mb-8">

    <h2 class="text-2xl font-bold mb-5">Create Theme</h2>

    <form action="{{ route('themes.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">

        @csrf

        <input type="text" name="name" id="theme-name" placeholder="Theme Name" class="p-3 rounded-xl border text-black dark:text-white dark:bg-gray-900 dark:border-gray-700" required>

        <input type="text" name="slug" id="theme-slug" placeholder="theme-slug" class="p-3 rounded-xl border text-black dark:text-white dark:bg-gray-900 dark:border-gray-700" required>

        <div class="flex items-center gap-2 border rounded-xl p-2 bg-gray-50 dark:bg-gray-900 dark:border-gray-700">
            <input type="color" name="primary_color" id="picker-primary" value="{{ session('primary_color', '#4f46e5') }}" class="w-10 h-10 rounded-lg cursor-pointer border-0">
            <span id="primary-hex" class="text-xs font-mono text-gray-500">{{ strtoupper(session('primary_color', '#4f46e5')) }}</span>
        </div>

        <div class="flex items-center gap-2 border rounded-xl p-2 bg-gray-50 dark:bg-gray-900 dark:border-gray-700">
            <input type="color" name="secondary_color" id="picker-secondary" value="{{ session('secondary_color', '#f3f4f6') }}" class="w-10 h-10 rounded-lg cursor-pointer border-0">
            <span id="secondary-hex" class="text-xs font-mono text-gray-500">{{ strtoupper(session('secondary_color', '#f3f4f6')) }}</span>
        </div>

        <button type="submit" class="theme-primary-bg text-white p-3 rounded-xl col-span-2 font-bold shadow-md hover:opacity-90 transition">
            Create Theme
        </button>

    </form>

</div>

<script>
    document.getElementById('picker-primary').addEventListener('input', function(e) {
        const val = e.target.value;
        document.getElementById('primary-hex').innerText = val.toUpperCase();
        document.documentElement.style.setProperty('--primary-color', val);
    });

    document.getElementById('picker-secondary').addEventListener('input', function(e) {
        const val = e.target.value;
        document.getElementById('secondary-hex').innerText = val.toUpperCase();
        document.documentElement.style.setProperty('--secondary-color', val);
    });

    document.getElementById('theme-name').addEventListener('input', function(e) {
        const slug = e.target.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '');
        document.getElementById('theme-slug').value = slug;
    });
</script>