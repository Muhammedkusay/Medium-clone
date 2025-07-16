
<a href="{{ route('post.show', ['username' => $post->user->username, 'post' => $post->slug]) }}" class="block mb-6 md:flex md:flex-row-reverse md:justify-between md:gap-2 bg-white hover:border-gray-300 hover:bg-gray-100 border border-gray-200 rounded-lg shadow-sm">
    <div class="md:w-2/5 h-32 md:h-full my-auto md:overflow-hidden relative">
        {{-- post image --}}
        <img class="w-full h-full md:h-56 rounded-t-lg md:rounded-tl-none md:rounded-r-lg object-cover" src="{{ $post->imageUrl() }}" alt="" />
        {{-- dark layer --}}
        <div class="absolute w-full h-full top-0 left-0 bg-gray-800 bg-opacity-25 rounded-t-lg md:rounded-tl-none md:rounded-r-lg z-20"></div>
    </div>

    <div class="md:w-3/5 flex flex-col p-5">
        {{-- post title --}}
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{Str::words($post->title, 7)}}</h5>
        {{-- post content --}}
        <p class="mb-3 font-normal text-gray-700">{{Str::words($post->content, 20)}}</p>
        
        <div class="w-full md:w-5/6 mt-auto flex flex-wrap items-center justify-between ">
            {{-- post created at --}}
            <div class="text-gray-500">
                <p>{{ $post->created_at->format('M d, Y') }}</p>
            </div>
            {{-- post category --}}
            <div class="text-gray-500 text-md">
                <p>{{ $post->category->name }}</p>
            </div>
            {{-- claps count --}}
            <div class="flex items-center gap-2 text-gray-500 text-md">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z" />
                </svg>
                <p>{{ $post->claps_count }}</p>
            </div>
        </div>

    </div>
</a>