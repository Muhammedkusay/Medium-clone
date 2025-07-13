
<ul class="flex flex-wrap justify-center text-sm font-medium text-center text-gray-500">
    <li class="me-2">
        <a 
            href="{{ route('dashboard') }}" 
            class="{{ request('category')
                        ? 'inline-block px-4 py-2 rounded-lg hover:text-gray-900 hover:bg-gray-100'
                        : 'inline-block px-4 py-2 text-white bg-blue-600 rounded-lg'
                    }}"
        >
            All
        </a>
    </li>
    @foreach ($categories as $category) 
    <li class="me-2">
        <a 
            href="{{ route('post.byCategory', $category) }}" 
            class="{{ 
                Route::currentRouteNamed('post.byCategory') 
                && request('category')->id == $category->id
                ? 'inline-block px-4 py-2 text-white bg-blue-600 rounded-lg' 
                : 'inline-block px-4 py-2 rounded-lg hover:text-gray-900 hover:bg-gray-100' 
            }}"
        >
            {{$category->name}}
        </a>
    </li>
    @endforeach
</ul>