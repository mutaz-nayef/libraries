@auth
<x-panel> 
    <form
    action="/books/{{$book->id}}/comments" method="POST"
    >
    @csrf

    <header class="flex items-center">
        <img
        src="https://i.pravatar.cc/50?u={{auth()->id()}}"
        width="50" height="50" alt=""
        class="rounded-full "
        >
        <h2 class="ml-4 font-semibold">Want to participate?</h2>
    </header>

    <div class="mt-4">
        <textarea
        class="w-full p-2 text-sm focus:outline-none focus:ring"
        name="body"
        id="text-area"
        rows="5"
        placeholder="Quick,think of something to say!"
        ></textarea>

        <x-form.errors name="body"/>
    </div>
    <div class="flex justify-end pt-6 border-t border-gray-200 ">

        <x-form.button id="submit-button">Publish</x-form.button>
    </div>
</form>
</x-panel>

@else
<p class="text-blue-500 font-bold">
    <a class="logre-to-comment hover:underline"
    href="/register">Register</a> or
    <a class="logre-to-comment hover:underline"
    href="/login">Log in</a> to
    leave a comment.
</p>
@endauth

<script type="text/javascript">
    $(document).ready(function(){
        const link = $(".logre-to-comment"),
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
</script>
