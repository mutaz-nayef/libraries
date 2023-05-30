@props(['library'])


<div class="flex ">

    <form method="POST"
    action="/libraries/{{ $library->id}}/like"
    class=" flex items-center justify-between gap-2 {{$library->isLikedBy(auth()->user()) ? 'text-red-500' : 'text-gray-500'}}" >
    @csrf
    <div>
    <svg xmlns="http://www.w3.org/2000/svg"  class=" fill-current  "
    style="width: 3em;height: 3em;vertical-align: middle;fill: currentColor;overflow: hidden;"
    viewBox="0 0 1024 1024" version="1.1">
    <path id='submit-button' class="cursor-pointer"
    d="M917.333333 384a213.333333 213.333333 0 0 0-405.333333-92.586667A213.333333 213.333333 0 1 0 168.533333 533.333333l344.533334 345.386667L857.6 533.333333h-1.92A213.333333 213.333333 0 0 0 917.333333 384z"
    fill=""/>
{{--     <button  type="submit"
    class="  text-xs flex items-center ">
</button> --}}
</svg>

</div>
<div id="library-likes" class=" text-sm">
    {{$library->likes->count() ?: 0 }}
</div>
</form>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.27.2/axios.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
    document.getElementById('submit-button').addEventListener("click", function(event){
        event.preventDefault()

        const url = '/libraries/{{$library->id}}/like';
        axios.post(url) .then(function(response){

            if(response.data.message == true){

                event.target.classList.add('text-red-500')
                document.getElementById('library-likes').classList.remove('text-gray-500')
                document.getElementById('library-likes').classList.add('text-red-500')

            }else{

                event.target.classList.remove('text-red-500')
                event.target.classList.add('text-gray-500')
                document.getElementById('library-likes').classList.remove('text-red-500')
                document.getElementById('library-likes').classList.add('text-gray-500')
            }
                    document.getElementById('library-likes').innerHTML = response.data.likes; // ${"#library-likes"}.val('') ;
                })
        .catch(function (error) {
            console.log(error);
        });

    });
</script>
