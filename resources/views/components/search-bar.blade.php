{{-- Search-bar --}}
<div class="pb-6 px-2 md:px-0 relative">
    <form class="flex" action="" method="get">
        @csrf
        <input id="search-bar" 
                name="search-bar" 
                type="text"
                class="w-full rounded-l-lg border border-gray-300"
                placeholder="Try post title, name or username"
        >
        <button class="w-2/12 md:w-24 bg-blue-700 text-white text-center rounded-r-lg">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" class="size-6 mx-auto">
                <path strokeLinecap="round" strokeLinejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
        </button>
    </form>

    {{-- suggestions --}}
    <div class="z-50 w-full cursor-pointer absolute p-1 rounded-lg border border-gray-300 bg-white shadow-lg">
        <div class="p-2 rounded-md hover:bg-gray-100">This is suggestion</div>
        <div class="p-2 rounded-md hover:bg-gray-100">This is suggestion</div>
        <div class="p-2 rounded-md hover:bg-gray-100">This is suggestion</div>

    </div>
</div>