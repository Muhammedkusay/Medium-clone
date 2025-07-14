<x-app-layout>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            {{-- status --}}
            @if (session()->has('status'))
                <div class="flex items-center p-4 my-3 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50" role="alert">
                <svg class="shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-bold">Info </span>{{ session('status') }}
                </div>
                </div>
            @endif

            {{-- category list --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900">
                    <x-category-tabs />
                </div>
            </div>

            {{-- posts --}}
            <div class="mt-6 px-2 md:px-0">
                @forelse ($posts as $post)
                    {{-- post card --}}
                    <x-post-item :post="$post" />
                @empty
                    <div class="text-gray-600 text-center p-4">No Posts Found</div>
                @endforelse
            </div>

            {{$posts->OnEachSide(2)->links()}}
        </div>
    </div>
</x-app-layout>
