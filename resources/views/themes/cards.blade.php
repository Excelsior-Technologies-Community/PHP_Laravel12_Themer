<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    @forelse($themes as $theme)

        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-lg">

            <div class="flex justify-between mb-4">

                <div>
                    <h2 class="text-2xl font-bold">{{ $theme->name }}</h2>
                    <p class="text-gray-500">{{ $theme->slug }}</p>
                </div>

                @if(session('theme','light') == $theme->slug)

                    <span class="bg-green-500 text-white px-3 py-1 rounded-full text-sm">
                        Active
                    </span>

                @endif

            </div>

            <form action="{{ route('themes.destroy', $theme->id) }}" method="POST">

                @csrf
                @method('DELETE')

                <button onclick="return confirm('Delete this theme?')"
                        class="bg-red-500 text-white px-5 py-2 rounded-xl">

                    Delete

                </button>

            </form>

        </div>

    @empty

        <div class="col-span-2 text-center text-gray-500">
            No Themes Found
        </div>

    @endforelse

</div>