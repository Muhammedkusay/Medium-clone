<x-app-layout>
    <div class="max-w-4xl md:mx-auto pt-8 md:pt-16 my-6 p-4 md:p-6 bg-white rounded-xl shadow-sm">
        {{-- title --}}
        <h2 class="font-extrabold text-3xl md:text-6xl text-gray-800 leading-tight mb-4 md:mb-6">
            {{ $post->title }}
        </h2>

        <div class="flex items-center justify-between mt-8 md:mt-16 pb-6 border-b">
            {{-- publisher info --}}
            <div class="flex items-center gap-2 md:gap-3">
                <a href="{{ route('profile.show', ['user' => $post->user]) }}">
                    <x-user-avatar :user="$post->user" />
                </a>
                <div>
                    <div class="flex items-center gap-3">
                        <a href={{ route('profile.show', ['user' => $post->user]) }} class="hover:underline">
                            <h3 class="text-lg md:text-xl">{{ $post->user->name }}</h3>
                        </a>
                        {{-- follow --}}
                        @if(auth()->user() && auth()->id() !== $post->user->id)
                        &middot
                        <x-follow-container :user="$post->user">
                            <button  
                                class="font-bold"
                                :class="following ? 'text-red-500 hover:text-red-700' : 'text-emerald-500 hover:text-emerald-700'"
                                x-text="following ? 'Unfollow' : 'Follow'"
                                @click="follow()"
                            ></button>
                        </x-follow-container>
                        @endif
                    </div>
                    <div class="flex gap-2 text-gray-500 text-sm">
                        <p>{{ $post->readTime() }}min read</p>
                        &middot
                        <p>{{ $post->created_at->format('M d, Y') }}</p>
                    </div>
                </div>
            </div>

            {{-- clap button --}}
            <x-clap-button :post="$post"/>
        </div>

        {{-- post image & content --}}
        <div class="mt-6">
            <div class="h-auto md:h-96 overflow-hidden">
                <img src="{{ $post->imageUrl() }}" alt="{{ $post->title }}" />
            </div>
            <div class="mt-8 md:mt-16">
                <h4 class="text-xl md:text-3xl">{{ $post->title }}</h4>
            </div>
            <div class="mt-6">
                {{ $post->content }}
            </div>
        </div>
        
        {{-- post category --}}
        <div class="w-fit mt-8 md:mt-16 border-t bg-gray-200 px-4 py-2.5 rounded-full">
            <p>{{ $post->category->name }}</p>
        </div>

    </div>
</x-app-layout>
