@props(['result','text','image','loop'])
<li class="border-b  border-blue-300">
    <a {{ $attributes->merge(['class' => 'flex items-center block  hover:bg-gray-200 px-3 py-3']) }}

       @if($loop->last)  @keydown.tab="isOpen=false" @endif
    >
        @if($result[$image])
            <img src="{{asset('storage/'.$result[$image])}}" alt="image">
        @else
            <img src="{{'https://via.placeholder.com/50x75'}}" alt="poster" class="w-8">
        @endif
        <span class="ml-4">{{ $text }}</span>
    </a>
</li>

