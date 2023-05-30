<x-app-layout>
    <section id="render" class=" px-6 py-8">

        <div class="max-w-6xl  mx-auto movie-info ">
            <div class="container mx-auto px-4 py-16 flex flex-col  md:flex-row">
                @if($book->image)
                <img src="{{asset('storage/'.$book->image)}}" alt="book img"
                style="width: 350px ;height: 450px;">
                @else
                <img src="/img/book-cover4.jpg" alt="book" style="width: 350px ;height: 450px;">
                @endif

                <div class="flex flex-col justify-start md:ml-24 mb-64 ">

                    <div class="hidden lg:flex justify-between pr-10 mb-5">
                        <a id="backTo" href="{{route('books.index')}}"
                        class="transition-colors duration-300 relative inline-flex items-center text-lg hover:text-blue-500">
                        <svg width="22" height="22" viewBox="0 0 22 22" class="mr-2">
                            <g fill="none" fill-rule="evenodd">
                                <path stroke="#000" stroke-opacity=".012" stroke-width=".5" d="M21 1v20.16H.84V1z">
                                </path>
                                <path class="fill-current"
                                d="M13.854 7.224l-3.847 3.856 3.847 3.856-1.184 1.184-5.04-5.04 5.04-5.04z">
                            </path>
                        </g>
                    </svg>

                    Back to Book
                </a>
                <a href="{{route('author.show',$book->author)}}"
                   class="transition ease-in-out duration-300 px-5 py-1 border border-blue-400 hover:bg-blue-400 hover:text-white rounded-full text-blue-400 text-xs uppercase font-semibold">
                   {{$book->author->name}}
               </a>

           </div>

           <div class="flex items-center mb-5 space-x-8">

            <h2 class="text-4xl mt-5 font-semibold">{{$book['title']}}</h2>
        </div>
        <div class="flex flex-wrap items-center text-gray-400 text-sm">
            <svg class="fill-current text-yellow-500 w-4" viewBox="0 0 24 24">
                <g data-name="Layer 2">
                    <path
                    d="M17.56 21a1 1 0 01-.46-.11L12 18.22l-5.1 2.67a1 1 0 01-1.45-1.06l1-5.63-4.12-4a1 1 0 01-.25-1 1 1 0 01.81-.68l5.7-.83 2.51-5.13a1 1 0 011.8 0l2.54 5.12 5.7.83a1 1 0 01.81.68 1 1 0 01-.25 1l-4.12 4 1 5.63a1 1 0 01-.4 1 1 1 0 01-.62.18z"
                    data-name="star"/>
                </g>
            </svg>
            {{--                        <span class="ml-1">{{$book['vote_average'] * 10 . '%'}}</span>--}}
            <span class="ml-1">78%</span>
            <span class=" mx-2">|</span>
            <span>{{\Carbon\Carbon::parse($book['published_at'])->format('M d, Y')}}</span>
        </div>
        <p class="text-gray-800 mt-8">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus adipisci aperiam architecto
            asperiores commodi consequatur culpa debitis distinctio est expedita fugiat molestiae natus
            numquam, obcaecati officia officiis quam quasi qui rem reprehenderit sit soluta vero voluptate?
            Enim placeat praesentium reiciendis.
        </p>
        <p class="text-gray-800 mt-8 ">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus adipisci aperiam architecto
            asperiores commodi consequatur culpa debitis distinctio est expedita fugiat molestiae natus
            numquam, obcaecati officia officiis quam quasi qui rem reprehenderit sit soluta vero voluptate?
            Enim placeat praesentium reiciendis.
        </p>

        <section class="mb-10 col-span-8 col-start-5 mt-10 space-y-6">

            @include('books.__add-comment-form')
            <div class="book-comments ">
                @foreach($book->comments as $comment)
                <x-book-comments :comment="$comment"/>
                @endforeach
                <div id="lastComment"></div>
            </div>
        </section>
    </div>
</div>
</div>


<script>
    @auth
    $('body').on('click','#submit-button',function(event){
      event.preventDefault()
      var body = document.getElementById('text-area').value

      axios.post('/books/{{$book->id}}/comments', {body: body})
      .then(response => {
        var card = $('.book-comments:first').append(`<div class="mb-5 rounded-xl p-6 border border-gray-200 bg-gray-50">
            <article class="flex  space-x-4">
            <div class="flex-shrink-0">
            <img src="https://i.pravatar.cc/60?u=${response.data.message.user_id}" width="60" height="60" alt="" class="rounded-xl">
            </div>
            <div>
            <header>
            <h3 class="font-bold text-blue-500"> ${response.data.message.user}</h3>

            <p class="text-sm text-gray-500 mb-4">
            Posted
            <time>{{\Carbon\Carbon::now()->format('F j, y, g:i a')}}</time>
            </p>
            </header>
            <p>
            ${response.data.message.body}
            </p>
            </div>
            </article>
            </div>`)
        console.log(card)
        $("#text-area").val('');
        document.getElementById("lastComment").scrollIntoView({
          behavior: 'smooth',
          block: "start", // or "end"
      });
    })
      .catch(function (error) {
        console.log(error);
    });
  })
    @endauth
    $(document).ready(function(){
        handleLocation('#backTo');
    })
</script>
</section>
</x-app-layout>




