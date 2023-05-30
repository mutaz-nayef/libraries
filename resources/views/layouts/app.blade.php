<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
    href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;400;700&family=DM+Sans:wght@400;700&family=Dancing+Script:wght@400;700&family=Montserrat+Subrayada&family=Montserrat:wght@200;400;700&family=Oswald:wght@200;300;700&family=Poppins:wght@300;700;800&family=Raleway:wght@300;600&family=Roboto:wght@100&family=Sen:wght@800&family=Signika+Negative:wght@300;400;500;600;700&display=swap"
    rel="stylesheet">
    <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0"/>
    <livewire:styles/>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    {{-- @vite('resources/css/app.css') --}}
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    @vite('resources/js/app.js')
    {{-- @vite('resources/js/main.Wjs') --}}
</head>
<body  class="transition ease-in-out duration-300" id="body" style="font-family: DM Sans, sans-serif">
    <section>

        @include('layouts.navigation')

        <!-- Page Heading -->

    <!-- Page Content -->
    <main  id="main" class=" transform  transition ease-in-out duration-300">
        {{ $slot }}
    </main>


    <footer
    class="bg-gray-100 border border-black border-opacity-5 rounded-xl text-center py-16 px-10 mt-56 mb-0">
    <p>
        © Library System {{date('Y')}}.
        Built with Love <3.
    </p>

</footer>
</section>
<x-flash/>
<livewire:scripts/>
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>  --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.27.2/axios.min.js"></script>  --}}


<script type="text/javascript">
@manager
   document.getElementById('manager-books').addEventListener("click",function(event){
    event.preventDefault();
    axios.get("/manager/books")
    .then(function(response){
        var data =  $(response.data).find("#books-dash").html();
        $('.main').html(data);
        window.history.pushState("", "", "/manager/books");

    })
})
   @endmanager

$('body').on('click','#app-logo',function(){

    event.preventDefault();
    window.history.pushState({}, "", '');
    axios.get('/')
    .then(function(response){
       var data =  $(response.data).find("#render").html();
       $('#main').html(data);
   })
})

   $(document).ready(function(){
    handleLocation('.nav-link');
})
      $(document).ready(function(){
    handleLocation('#backTo');
})
   function handleLocation(className){
    $(document).ready(function(){
        const link = $(className),
        render = $('#main');
        link.on('click',function(event){
            event.preventDefault();
            window.history.pushState({}, "", event.target.href);
            let route = $(this).attr('href');
            axios.get(route)
            .then(function(response){
             var data =  $(response.data).find("#render").html();
             render.html(data);
         })
        })

    })
}

window.addEventListener('popstate', (event) => {
   axios.get(document.location)
   .then(function(response){
     var data =  $(response.data).find("#render").html();
     $("#main").html(data);
 })
});

// $('body').on('click','#book-show',function(){
//     render = $('#main');
//     let id = $(this).data('id')
//     event.preventDefault();
//     console.log(id)
//     window.history.pushState({}, "", event.target.href);
//     axios.get('/books/'+id)
//     .then(function(response){
//        var data =  $(response.data).find("#render").html();
//        render.html(data);
//    })
// })
function showElement(id_div,url){

    $('body').on('click','#'+id_div,function(){
        render = $('#main');
        let id = $(this).data('id')
        if($("#li-search")){
            $("#li-search").css('display','none')
        }
        if($("#input-search")){
            $("#input-search").val('')
        }

        event.preventDefault();
        console.log(id)
        window.history.pushState({}, "", '/'+url+'/'+id);
        axios.get('/'+url+'/'+id)
        .then(function(response){
         var data =  $(response.data).find("#render").html();
         render.html(data);
     })
    })
}

showElement('library-show','libraries')
showElement('book-show','books')
showElement('author-show','authors')
function authLinks(id_div,url){

    $('body').on('click','#'+id_div,function(){
        render = $('#main');
        event.preventDefault();
        window.history.pushState({}, "", '/'+url);
        axios.get('/'+url)
        .then(function(response){
         var data =  $(response.data).find("#render").html();
         render.html(data);
     })
    })
}

@auth
@else
authLinks('login','login')
authLinks('register','register')
@endauth

</script>
</body>
</html>
