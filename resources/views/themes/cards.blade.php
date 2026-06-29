<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    @forelse($themes as $theme)

        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-lg flex flex-col justify-between transition hover:shadow-2xl">

            <div>
                <div class="flex justify-between mb-4">

                    <div>
                        <h2 class="text-2xl font-bold">{{ $theme->name }}</h2>
                        <p class="text-gray-500 mb-3">{{ $theme->slug }}</p>
                    </div>

                    @if(session('theme','light') == $theme->slug)

                        <span class="bg-green-500 text-white px-3 py-1 rounded-full text-sm h-fit">
                            Active
                        </span>

                    @endif

                </div>

                <div class="flex gap-2 mb-4">
                    <div class="w-6 h-6 rounded-full border border-gray-300 shadow-inner" style="background-color: {{ $theme->primary_color }}"></div>
                    <div class="w-6 h-6 rounded-full border border-gray-300 shadow-inner" style="background-color: {{ $theme->secondary_color }}"></div>
                </div>
            </div>

            <div class="flex gap-2 border-t pt-4 mt-2 border-gray-100 dark:border-gray-700">
                <form action="{{ route('theme.switch') }}" method="POST" class="flex-1">
                    @csrf
                    <input type="hidden" name="theme_id" value="{{ $theme->id }}">
                    <button type="submit" class="w-full bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold py-2 rounded-xl transition dark:bg-gray-700 dark:hover:bg-gray-600">
                        Activate
                    </button>
                </form>

                <form action="{{ route('themes.destroy', $theme->id) }}" method="POST">

                    @csrf
                    @method('DELETE')

                    <button onclick="return confirm('Delete this theme?')"
                            class="bg-red-500 text-white px-5 py-2 rounded-xl text-xs font-bold hover:bg-red-600 transition">
                        Delete
                    </button>

                </form>
            </div>

        </div>

    @empty

        <div class="col-span-2 text-center text-gray-500 py-6">
            No Themes Found
        </div>

    @endforelse

</div>