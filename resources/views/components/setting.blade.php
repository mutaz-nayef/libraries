@props(['heading'])

<section class="py-4 max-w-7xl mx-auto">

    <h1 class="text-xl font-bold uppercase mb-8 pb-2 border-b">
        {{$heading}}
    </h1>

    <div class="flex">
        <aside class="w-32 flex-shrink-0 ">
            <h4 class="font-bold mb-4 uppercase">Links</h4>
            <ul class="uppercase">
                <li>
                    <a href="{{route('manager.books')}}"
                       class="{{request()->routeIs('manager.books') ? 'text-blue-500' : ''}}" id="all-books"
                       >All
                        Books</a>
                </li>
                <li>
                    <a href="{{route('manager.book.create')}}"
                       class="{{request()->routeIs('manager.book.create') ? 'text-blue-500' : ''}}" id="new-books">New Book</a>
                </li>
            </ul>

        </aside>

        <main class="main flex-1">
            {{$slot}}
        </main>
    </div>

</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.27.2/axios.min.js"></script>

<script type="text/javascript">
    //  document.getElementById('all-books').addEventListener("click",function(event){
    //     event.preventDefault();
    //     axios.get("/manager/books")
    //     .then(function(response){
    //      var data =  $(response.data).find("#sub-books").html();
    //        $('.sub-books').html(data);
    //         // console.log(response.data)
    //         // $('#body').html(response.data);
    //         window.history.pushState("", "", "/manager/books");

    //     })
    // })
         $(document).ready(function(){
    handleLocation('#all-books');
})


    // document.getElementById('edit-book').addEventListener("click",function(event){
    //     event.preventDefault();
    //        $('#create-book').css('left','auto');
    // })

</script>
