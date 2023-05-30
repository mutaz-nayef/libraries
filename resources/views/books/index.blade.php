<x-app-layout>
    <div id="render">

    <section class=" px-6 py-8">

        <main class=" max-w-6xl mx-auto">
            <div class="container mx-auto px-4 ">
                <div class="popular-book">
                    @foreach($categories as $category)
                        @if($category->books->count() > 0)
                            <h2 class="uppercase tracking-wider mt-10 text-blue-500 text-lg font-semibold">
                                {{$category->name}}
                            </h2>
                            <div class="grid  sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                                @foreach($category->books as $book)
                                    <x-book-card :book="$book"/>
                                @endforeach
                            </div>
                        @endif
                    @endforeach

                </div>

            </div>

        </main>
        <div class="max-w-6xl mx-auto mt-10">
            {{$categories->links()}}
        </div>
    </section>
    </div>
 {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.27.2/axios.min.js"></script>
 --}}
<script type="text/javascript">

   // document.getElementById('book-show').addEventListener("click",function(event){
    // event.preventDefault();
    // axios.get(event.target.href)
    // .then(function(response){
        // var data =  $(response.data).find("#render").html();
        // $('.main').html(data);
        // window.history.pushState("", "", event.target.href);

    // })
// })



</script>



</x-app-layout>
