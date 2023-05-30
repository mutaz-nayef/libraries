<x-app-layout>
    <div id="render">

    <section class=" bg-gray-200 px-6 py-4 pb-10">

        <main class=" max-w-6xl mx-auto py-6 ">

            <div class="container mx-auto px-4 mt-20 ">
                <div class="grid  sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-8">
                    @foreach($authors as $author)
                        <x-author-card :author="$author"/>
                    @endforeach
                </div>

            </div>

        </main>
    </section>
    <div class="max-w-6xl mx-auto mt-10">
        {{$authors->links()}}
    </div>

    </div>
    <script>
    //     $(document).ready(function(){
    //         // handleLocation(".author-card");
    //     const link = $(".author-card"),
    //     render = $('#main');
    //     link.on('click',function(event){
    //         event.preventDefault();
    //      console.log(event.target.href)
    //         window.history.pushState({}, "", event.target.href);
    //         let route = $(this).attr('href');
    //         axios.get(route)
    //         .then(function(response){
    //          var data =  $(response.data).find("#render").html();
    //          render.html(data);
    //      })
    //     })

    // })
    </script>
</x-app-layout>
