
<ul class="flex flex-wrap justify-center text-sm font-medium text-center text-gray-500">
    <li class="me-2">
        <a href="#" class="inline-block px-4 py-2 text-white bg-blue-600 rounded-lg active" aria-current="page">All</a>
    </li>
    @foreach ($categories as $category) 
    <li class="me-2">
        <a href="#" class="inline-block px-4 py-2 rounded-lg hover:text-gray-900 hover:bg-gray-100" aria-current="page">{{$category->name}}</a>
    </li>
    @endforeach
</ul>