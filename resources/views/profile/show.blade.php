<x-app-layout>
    <div class="max-w-5xl md:mx-auto my-6 p-4 md:p-6 bg-white rounded-xl shadow-sm">
        <div class="flex flex-col-reverse md:flex-row justify-between gap-6">

            <div class="md:w-4/6 pt-6 md:pr-6 md:border-r">
                <h2 class="text-2xl md:text-5xl font-bold">{{ $user->name }}</h2>
                <h2 class="text-md md:text-lg text-gray-500">{{ '@' . $user->username }}</h2>

                {{-- posts --}}
                <div class="mt-2 md:mt-12 px-2 md:px-0">
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
            <div class="md:w-2/6" >
                <div class="p-3 bg-gray-100 border rounded-lg">
                    <x-follow-container :user="$user">
                        {{-- name, username, bio --}}
                        <div class="flex items-start gap-4">
                            <x-user-avatar :user="$user" class="w-[80px] h-[80px] md:w-24 md:h-24"/>
                            <div>
                                <h3 class="text-wrap text-md md:text-xl font-bold pt-1">{{ Str::words($user->name, 2) }}</h3>
                                <h4 class="text-md pt-1 text-gray-600">{{ '@' . $user->username }}</h4>
                                <p class="text-md pt-1 text-gray-600"><span x-text="followersCount" class="pr-1"></span>followers</p>
                            </div>
                        </div>

                        @if ($user->bio)
                            <div class="text-md mt-4 py-1 px-2">{{ $user->bio }}</div>
                        @else
                            <div class="text-md mt-4 py-1 px-2">No bio!</div>
                        @endif

                        {{-- followers & follow section --}}
                        {{-- the user is authenticated --}}
                        @if (auth()->user())
                            {{-- authenticated user !== publisher --}}
                            @if (auth()->user()->id !== $user->id)
                                <button class="w-full">
                                    <a 
                                        href="#" 
                                        @click="follow()"
                                        x-text="following ? 'Unfollow' : 'Follow'" 
                                        class="block mt-4 px-6 py-1.5 rounded-full shadow-sm"
                                        :class="following ? 'text-red-700 bg-red-50 hover:bg-red-100' : ' text-white bg-emerald-700 hover:bg-emerald-800'">
                                    </a>
                                </button>
                            @endif
                        {{-- the user is not authenticated --}}
                        @else
                            <a href="{{ route('login') }}" 
                               class="block text-center text-white mt-4 px-6 py-1.5 rounded-full shadow-sm bg-emerald-700 hover:bg-emerald-800">
                               Follow
                            </a>
                        @endif
                    </x-follow-container>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
