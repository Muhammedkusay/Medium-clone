<x-app-layout>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

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
