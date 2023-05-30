<div class="container">

    <div class="relative mt-3 md:mt-0" x-data="{isOpen:true}" @click.away="isOpen = false">
        <input id="input-search" @focus="isOpen = true" @keydown="isOpen=true"
               @keydown.escape.window="isOpen=false"
               @keydown.shift.tab="isOpen=false"
               class="bg-gray-200 rounded-full w-96 px-4 pl-8 py-2 focus:outline-none focus:shadow-outline "
               placeholder="Search"
               type="text"
               wire:model.debounce.500ms.="search"
        >
        <div class="absolute top-0">
            <svg class=" fill-current text-gray-500  mt-2 ml-2 " xmlns="http://www.w3.org/2000/svg"
                 fill="#9E9E9E" viewBox="0 0 30 30" width="20px"
                 height="20px">
                <path
                    d="M 13 3 C 7.4889971 3 3 7.4889971 3 13 C 3 18.511003 7.4889971 23 13 23 C 15.396508 23 17.597385 22.148986 19.322266 20.736328 L 25.292969 26.707031 A 1.0001 1.0001 0 1 0 26.707031 25.292969 L 20.736328 19.322266 C 22.148986 17.597385 23 15.396508 23 13 C 23 7.4889971 18.511003 3 13 3 z M 13 5 C 17.430123 5 21 8.5698774 21 13 C 21 17.430123 17.430123 21 13 21 C 8.5698774 21 5 17.430123 5 13 C 5 8.5698774 8.5698774 5 13 5 z"/>
            </svg>
        </div>

        @if(strlen($search) >=2)
            <div
                class="absolute z-50 bg-white text-sm rounded bg-gray-100 w-96 mt-2"
                x-show.transistion.opacity="isOpen">


                @if($books->count() > 0)
                    <ul id="li-search">
                        @foreach($books as $result)

                            <x-li-search-result id="book-show" data-id="{{$result['id']}}" href="{{route('book.show',$result['id'])}}" :result="$result"
                                                :text="$result->title" :image="$result->image" :loop="$loop"/>
                        @endforeach
                    </ul>
                @elseif($authors->count() > 0)

                    <ul id="li-search">
                        @foreach($authors as $result)

                            <x-li-search-result id="author-show" data-id="{{$result['id']}}" href="{{route('author.show',$result)}}" :result="$result"
                                                :text="$result->name" :image="$result->image" :loop="$loop"/>
                        @endforeach
                    </ul>
                @elseif($libraries->count() > 0)

                    <ul id="li-search">
                        @foreach($libraries as $result)

                            <x-li-search-result id="library-show" data-id="{{$result['id']}}" href="{{route('library.show',$result)}}" :result="$result"
                                                :text="$result->name" :image="$result->image" :loop="$loop"/>
                        @endforeach
                    </ul>

                @else
                    <div class="px-3 py-3">
                        No results for "{{ $search }}"
                    </div>
                @endif
            </div>

    </div>
    @endif
</div>
