<div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-lg mb-8">

    <h2 class="text-2xl font-bold mb-5">Create Theme</h2>

    <form action="{{ route('themes.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">

        @csrf

        <input type="text" name="name" placeholder="Theme Name" class="p-3 rounded-xl border text-black">

        <input type="text" name="slug" placeholder="theme-slug" class="p-3 rounded-xl border text-black">

        <input type="text" name="primary_color" placeholder="Primary Color" class="p-3 rounded-xl border text-black">

        <input type="text" name="secondary_color" placeholder="Secondary Color"
            class="p-3 rounded-xl border text-black">

        <button class="bg-blue-600 text-white p-3 rounded-xl col-span-2">
            Create Theme
        </button>

    </form>

</div>