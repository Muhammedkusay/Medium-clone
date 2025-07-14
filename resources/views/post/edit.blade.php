<x-app-layout>
    <div class="max-w-4xl sm:px-6 lg:px-8 mx-4 md:mx-auto my-4 py-4 px-4 md:px-0 bg-white shadow-md rounded-lg">

        {{-- flash message --}}

        <h2 class="font-semibold text-xl md:text-2xl text-gray-800 leading-tight mt-4 mb-6 md:mb-10">
            Update Post <span class="text-lg font-normal py-1 px-2 ml-2 bg-gray-200 text-gray-700 rounded-md ">{{ $post->title }}</span>
        </h2>

        <form action="{{ route('post.update', $post->slug) }}" enctype="multipart/form-data" method="post">
            @csrf
            @method('put')
            {{-- show image --}}
            <div class="h-auto md:h-96 mb-8 md:mb-12 overflow-hidden">
                <img src="{{ $post->imageUrl() }}" alt="{{ $post->title }}" />
            </div>
            <div class="md:flex md:justify-between">
                {{-- upload new image --}}
                <div class="mb-4">
                    <x-input-label for="image" :value="__('Image')" class="mb-1"/>
                    <div class="border border-gray-300 overflow-hidden rounded-lg p-1 bg-gray-50 shadow-sm">
                        <x-text-input id="image" class="block w-full cursor-pointer border-0 rounded-none shadow-none bg-gray-50" type="file" name="image" :value="old('image')" />
                    </div>
                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                </div>
    
                {{-- category --}}
                <div class="mb-4 w-full md:w-1/2">
                    <x-input-label for="category_id" :value="__('Category')" />
                    <select name="category_id" id="category_id" class="w-full mt-1 cursor-pointer border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        <option value="">Select a category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('category_id', $post->category_id) == $category->id) >{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                </div>
            </div>

            {{-- title --}}
            <div class="mb-4">
                <x-input-label for="title" :value="__('Title')" />
                <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $post->title)" autocomplete="title" />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            {{-- content --}}
            <div class="mb-4">
                <x-input-label for="content" :value="__('Content')" />
                <x-textarea id="content" class="block mt-1 w-full" name="content" autocomplete="content">{{ old('content', $post->content) }}</x-textarea>
                <x-input-error :messages="$errors->get('content')" class="mt-2" />
            </div>

            <x-primary-button class="mt-4">
                {{ __('Submit') }}
            </x-primary-button>
        </form>
    </div>
</x-app-layout>
