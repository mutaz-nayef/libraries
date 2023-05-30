@props(['author'])
<div class="transform hover:-translate-y-2 transition duration-300 px-6 py-6 w-full bg-white mt-5 ">


    <div class="relative flex  justify-between">
        {{-- <a class="author-card" href="{{route('author.show',$author)}}"> --}}
        <a id="author-show" data-id="{{$author->id}}" class="author-card font-bold text-xl w-56 uppercase text-blue-500" href="{{route('author.show',$author)}}">
        {{$author->name}}
        </a>
        <a href="{{route('author.show',$author)}}" id="author-show" data-id="{{$author->id}}">

        <img src="/img/author.png"
             class="absolute -top-16 border-8 border-gray-200 rounded-full w-28 h-28"
             alt=""
             style="right: -2.5rem;">
        </a>
    </div>
    <p class="mt-4">
        +160 Published Books
    </p>
    <p class="text-gray-500 text-sm mt-5">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus alias, aliquid at atque
        dicta
        sit.
    </p>
</div>
