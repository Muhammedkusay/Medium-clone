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
                        @if(auth()->user())
                            @if(auth()->id() !== $post->user->id)
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
                        @else
                            <a href={{ route('login') }}
                               class="font-bold text-emerald-500 hover:text-emerald-700">
                               Follow
                            </a>
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
        
        {{-- edit & delete buttons --}}
        @if (auth()->user() && auth()->id() == $post->user_id)            
            <div class="w-fit ml-auto mt-6 flex gap-3">
                {{-- edit --}}
                <a href="{{ route('post.edit', $post->slug) }}" class="w-24 flex items-center justify-center gap-1 px-3 py-2 rounded-lg text-gray-700 bg-gray-100 hover:bg-emerald-50 border-2 border-emerald-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                    </svg>
                    Edit
                </a>

                {{-- delete --}}
                <form action="{{ route('post.destroy', $post) }}" method="POST">
                    @csrf
                    @method('delete')

                    <Button class="w-24 flex items-center justify-center gap-1 px-3 py-2 rounded-lg text-gray-700 bg-gray-100 hover:bg-red-50 border-2 border-red-300">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                        Delete
                    </Button>
                </form>
            </div>
        @endif

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
