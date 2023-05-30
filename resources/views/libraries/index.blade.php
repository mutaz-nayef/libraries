<x-app-layout>
    <div id="render">
        <section class="bg-gray-200 px-6 py-4 pb-10">
            <main  class=" max-w-6xl mx-auto ">

                <div class="container mx-auto px-4 mt-20 ">
                    <div class=" mx-auto grid  sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3  gap-10">
                        @foreach($libraries as $library)
                        <x-library-card :library="$library"/>
                        @endforeach
                    </div>

                </div>

            </main>
        </section>
        <div class="max-w-6xl mx-auto mt-10">
            {{$libraries->links()}}
        </div>
    </div>

    <script type="text/javascript">

    //     $('body').on('click','#library-show',function(){
    //     render = $('#main');
    //     let id = $(this).data('id')
    //     event.preventDefault();
    //     console.log(id)
    //     window.history.pushState({}, "", event.target.href);
    //     axios.get('/libraries/'+id)
    //     .then(function(response){
    //        var data =  $(response.data).find("#render").html();
    //        render.html(data);
    //    })
    // })
</script>


</x-app-layout>
