    <x-app-layout>
<div id="render">

    <x-slot name="header">
        <h2 class="font-semibold text-xl bg-none leading-tight">
            @auth
                {{ __('Welcome, '). auth()->user()->username }}

            @else
                {{ __('Welcome!!') }}

            @endauth
        </h2>
    </x-slot>


    <div class=" bg-gray-200 lg:mt-20 mt-96  mx-auto sm:px-6 lg:px-32 py-16">

        <div class="font-bold uppercase text-2xl mb-10 ">
            Best Libraries
        </div>
        <div class=" mx-auto grid  sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3  gap-10">
            @foreach($libraries as $library)
                <x-library-card :library="$library"/>
            @endforeach
        </div>
        <div class="mt-10">
            <x-button  href="{{route('libraries.index')}}">View All Libraries</x-button>
        </div>
    </div>


    <div class=" mt-10 mx-auto sm:px-6 lg:px-32 py-16">

        <div class="font-bold uppercase text-2xl mb-10 ">
            Most Selling Books
        </div>


        <div class="grid  sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
            @foreach($books as $book)
                <x-book-card :book="$book"/>
            @endforeach
        </div>
        <div class="mt-10">
            <x-button href="{{route('books.index')}}">View All Books</x-button>
        </div>
    </div>

    <div class="bg-gray-200 mt-10 mx-auto sm:px-6 lg:px-32 py-16">

        <div class="font-bold uppercase text-2xl mb-20 ">
            Most Popular Authors
        </div>


        <div class="grid  sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-8">

            @foreach($authors as $author)
                <x-author-card :author="$author"/>
            @endforeach
        </div>
        <div class="mt-10">
            <x-button href="{{route('authors.index')}}">View All Authors</x-button>
        </div>
    </div>



</div>
<script>
  $('body').on('click','#view-all',function(){
        // const link = $(".view-all"),
        render = $('#main');
            event.preventDefault();
            window.history.pushState({}, "", event.target.href);
            let route = $(this).attr('href');
            axios.get(route)
            .then(function(response){
             var data =  $(response.data).find("#render").html();
             render.html(data);
         })
        })


</script>
</x-app-layout>
