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
