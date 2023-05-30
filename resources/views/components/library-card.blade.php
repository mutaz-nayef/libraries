@props(['library'])

<div class="mt-4">
    <div class="border border-white overflow-hidden" style="border-width: 13px">
        <a id="library-show" data-id="{{$library->id}}" href="{{route('library.show',$library)}}">
        <img src="/img/gallery-01.png"
             class="transform hover:rotate-6 hover:scale-110 transition ease-in-out duration-300 hover:opacity-80 "
             alt="">
        </a>
    </div>
    <div class="flex flex-col px-4 py-2 mt-4">
        <a id="library-show" data-id="{{$library->id}}" class="text-xl font-semibold text-blue-500" href="{{route('library.show',$library)}}">
    {{ucwords($library->name)}}
        </a>
        <p class="text-sm mt-4 text-gray-500">
            {{$library->address}}
        </p>
    </div>
</div>
