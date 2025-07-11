<x-app-layout>
    <div class="max-w-5xl md:mx-auto my-6 p-4 md:p-6 bg-white rounded-xl shadow-sm">
        <div class="flex justify-between gap-6">

            <div class="md:w-3/4 pt-6 md:pr-6 md:border-r">
                <h2 class="text-2xl md:text-5xl font-bold">{{ $user->name }}</h2>
                <h2 class="text-md md:text-lg text-gray-500">{{ '@' . $user->username }}</h2>

                {{-- posts --}}
                <div class="mt-6 md:mt-12 px-2 md:px-0">
                    <p class="mb-4 md:mb-6 text-lg md:text-xl">Posts by <span class="font-bold">{{ $user->name }}</span></p>
                    @forelse ($posts as $post)
                        {{-- post card --}}
                        <x-post-item :post="$post" />
                    @empty
                        <div class="text-gray-600 text-center p-4">No Posts Found</div>
                    @endforelse

                    {{ $posts->links() }}
                </div>
            </div>

            {{-- user info --}}
            <div class="md:w-1/4" >
                <x-follow-container :user="$user">
                    <x-user-avatar :user="$user" class="w-21 h-21 md:w-28 md:h-28"/>
                    <h3 class="text-md md:text-lg font-bold pt-3">{{ $user->name }}</h3>
                    <p  class="text-md md:text-lg text-gray-500 pt-1"><span x-text="followersCount" class="pr-1"></span>followers</p>
                    <div class="text-md md:text-lg text-gray-500 pt-1">{{ $user->bio }}</div>
                    {{-- followers & follow section --}}
                    @if (auth()->user() && auth()->user()->id !== $user->id)
                        <button>
                            <a 
                                href="#" 
                                @click="follow()"
                                x-text="following ? 'Unfollow' : 'Follow'" 
                                class="block text-white mt-6 px-4 py-2 rounded-full shadow-sm"
                                :class="following ? 'bg-emerald-600 hover:bg-emerald-700' : 'bg-emerald-700 hover:bg-emerald-800'">
                            </a>
                        </button>
                    @endif
                </x-follow-container>
            </div>

        </div>
    </div>
</x-app-layout>
