{{-- Search-bar --}}
<div class="pb-6 px-2 md:px-0 relative"        
    x-data="{
        suggestions: [],
        openSugg: false,
        async search(event) {
            let value = event.target.value.trim()
            if(value.length === 0) {
                this.openSugg = false
                return
            }
            {{-- send the request --}}
            await axios.get(`/search?q=${value}`)
                .then((res) => {
                    this.suggestions = res.data.suggestions
                    this.openSugg = true
                })
                .catch(err => console.log(err))
        }
    }">

    {{-- input --}}
    <div class="flex">
        <input id="search-bar" 
                name="search-bar" 
                type="text"
                autocomplete="off"
                class="w-full rounded-l-lg border border-gray-300"
                placeholder="Try post title, name or username"
                @input="search">

        <div class="w-2/12 md:w-24 flex items-center justify-center bg-gray-300 text-gray-800 text-center rounded-r-lg">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" class="size-6">
                <path strokeLinecap="round" strokeLinejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
        </div>
    </div>

    {{-- suggestions --}}
    <div x-show="openSugg" x-transition class="z-50 w-[96%] md:w-full cursor-pointer absolute p-1 rounded-lg border border-gray-300 bg-white shadow-lg">
        {{-- for loop on suggestions came from controller as json response --}}
        <template x-for="suggestion in suggestions">
            <a class="flex justify-between p-2 rounded-md hover:bg-gray-100"
                :href="suggestion.title ? `/@user-${suggestion.user_id}/${suggestion.slug}` : `/@${suggestion.username}`">

                <span x-text="suggestion.title || '@'+suggestion.username"></span>
                {{-- user svg --}}
                <template x-if="suggestion.username !== undefined">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5 text-gray-600">
                    <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
                    </svg>
                </template>
                {{-- post svg --}}
                <template x-if="suggestion.title !== undefined">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5 text-gray-600">
                        <path fill-rule="evenodd" d="M4.125 3C3.089 3 2.25 3.84 2.25 4.875V18a3 3 0 0 0 3 3h15a3 3 0 0 1-3-3V4.875C17.25 3.839 16.41 3 15.375 3H4.125ZM12 9.75a.75.75 0 0 0 0 1.5h1.5a.75.75 0 0 0 0-1.5H12Zm-.75-2.25a.75.75 0 0 1 .75-.75h1.5a.75.75 0 0 1 0 1.5H12a.75.75 0 0 1-.75-.75ZM6 12.75a.75.75 0 0 0 0 1.5h7.5a.75.75 0 0 0 0-1.5H6Zm-.75 3.75a.75.75 0 0 1 .75-.75h7.5a.75.75 0 0 1 0 1.5H6a.75.75 0 0 1-.75-.75ZM6 6.75a.75.75 0 0 0-.75.75v3c0 .414.336.75.75.75h3a.75.75 0 0 0 .75-.75v-3A.75.75 0 0 0 9 6.75H6Z" clip-rule="evenodd" />
                        <path d="M18.75 6.75h1.875c.621 0 1.125.504 1.125 1.125V18a1.5 1.5 0 0 1-3 0V6.75Z" />
                    </svg>
                </template>
            </a>
        </template>

        {{-- suggestions array is empty --}}
        <template x-if="suggestions.length === 0">
            <div class="p-2 rounded-md hover:bg-gray-100">No matching results</div>
        </template>
    </div>
</div>