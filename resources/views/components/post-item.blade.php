
<div class="mb-6 md:flex md:flex-row-reverse md:justify-between bg-white border border-gray-200 rounded-lg shadow-sm">
    <div class="md:w-1/2 h-32 md:h-full md:overflow-hidden relative">
        {{-- render a random image if not exist in storage --}}
        <a href="{{ route('post.show', ['username' => $post->user->username, 'post' => $post->slug]) }}">
            <img class="rounded-t-lg md:rounded-tl-none md:rounded-r-lg object-cover md:object-scale-down" src="{{ $post->imageUrl() }}" alt="" />
        </a>
        {{-- dark layer --}}
        <div class="absolute w-full h-full top-0 left-0 bg-gray-800 bg-opacity-25 rounded-t-lg md:rounded-tl-none md:rounded-r-lg z-20"></div>
    </div>
    <div class="md:w-1/2 flex flex-col p-5">
        <a href="{{ route('post.show', ['username' => $post->user->username, 'post' => $post->slug]) }}">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{$post->title}}</h5>
        </a>
        <p class="mb-3 font-normal text-gray-700">{{Str::words($post->content, 20)}}</p>
        <div class="flex items-center gap-3 mt-auto">
            <div>
                <a href="{{ route('post.show', ['username' => $post->user->username, 'post' => $post->slug]) }}">
                    <x-primary-button>
                        Read more
                    </x-primary-button>
                </a>
            </div>
            <div class="text-gray-500 text-md">
                <p>{{ $post->category->name }}</p>
            </div>
        </div>
    </div>
</div>