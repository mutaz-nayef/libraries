<x-app-layout>
    <div id="render" class="relative">
        <section class="px-4 py-4">


            <x-alert title="Create" class="alert-create-book" >
                <div id="create-book-content">
                </div>
            </x-alert>

            <x-alert title="update" class="alert-update-book" >
                <div id="update-book-content">
                   {{-- panel --}}
               </div>
           </x-alert>

           <main class="max-w-6xl mx-auto mt-5">

            <form class=" max-w-4xl mx-auto" method="GET" action="">
                <div class="flex">
                    <div class="relative w-full">
                        @if(request('author'))
                        <input type="hidden" name="author" value="{{request('author')}}">
                        @endif
                        @if(request('category'))
                        <input type="hidden" name="category" value="{{request('category')}}">
                        @endif
                        <input id="search" type="search" name="search"
                        class=" rounded-xl focus:outline-none block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50  border-l-gray-50 border-l-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-l-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500"
                        placeholder="Search Book title, ISPN, publish date..." required>
                        <button id="manager-search" type="submit"
                        class="absolute top-0 right-0 p-2.5 text-sm font-medium
                        text-white bg-blue-700 rounded-r-xl border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg aria-hidden="true" class="w-5 h-5" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <span class="sr-only">Search</span>
                </button>
            </div>
        </div>
    </form>

    <div class="flex items-center justify-center space-x-8 mt-10">

        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button
                class=" relative bg-gray-200 rounded-lg py-2 pl-3 pr-9  space-x-4 text-sm bg-transparent font-semibold w-full  lg:w-48 text-left flex lg:inline-flex items-center justify-between">
                <div>Authors</div>

                <div class="ml-1">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    clip-rule="evenodd"/>
                </svg>
            </div>
        </button>
    </x-slot>

    <x-slot name="content">
        @foreach($authors as $author)
        <x-dropdown-link
        class="block text-left px-3 text-sm uppercase leading-6 hover:bg-blue-500 hover:text-white focus:text-white"
        href="/manager/books/?author={{$author->name}}&
        {{http_build_query(request()->except('author','page'))}}">
        <span>{{$author->name}}</span>
    </x-dropdown-link>
    @endforeach
</x-slot>
</x-dropdown>

<x-dropdown align="right" width="48">
    <x-slot name="trigger">
        <button
        class="relative bg-gray-200 rounded-lg py-2 pl-3 pr-9  space-x-4 text-sm bg-transparent font-semibold w-full  lg:w-48 text-left lg:inline-flex flex items-center justify-between">
        <div>Categories</div>

        <div class="ml-1">
            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 20 20">
            <path fill-rule="evenodd"
            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
            clip-rule="evenodd"/>
        </svg>
    </div>
</button>
</x-slot>

<x-slot name="content">
    @foreach($categories as $category)
    <x-dropdown-link
    class="block text-left px-3 text-sm uppercase leading-6 hover:bg-blue-500 hover:text-white focus:text-white"
    href="/manager/books/?category={{$category->slug}}&
    {{http_build_query(request()->except('category','page'))}}">
    <span>{{$category->name}}</span>
</x-dropdown-link>
@endforeach
</x-slot>
</x-dropdown>
</div>


<x-setting id="setting" heading="Books">

    <div id="sub-books">
        <div class=" max-w-7xl flex flex-col ">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block  sm:px-4 lg:4x-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class=" divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                    class="px-4 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Id
                                </th>
                                <th scope="col"
                                class="px-4 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                ispn
                            </th>
                            <th scope="col"
                            class="px-4 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Title
                        </th>
                        <th scope="col"
                        class="px-4 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Author
                    </th>
                    <th scope="col"
                    class="px-4 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    publish date
                </th>
                <th scope="col"
                class="px-4 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Action
            </th>
        </tr>
    </thead>
    @if($books->count() > 0)
    <tbody id="tbody" class="books-tbody bg-white divide-y divide-gray-200">

        @foreach($books as $book)

        <tr class="item{{$book->id}}">
            <td class="px-4 py-4 whitespace-nowrap">
                {{$loop->index+1}}
            </td>
            {{--<td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">--}}
                {{--    <img src="{{asset('storage/'. $book->image)}}" alt="Book Image">--}}
            {{--</td>--}}
            <td class="px-4 py-4 whitespace-nowrap">
                {{$book->ispn}}
            </td>
            <td class=" py-4 whitespace-nowrap">
                <span class="px-1 inline-flex text-sm leading-5 font-bold ">
                    {{$book->title}}
                </span>
            </td>
            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">
                {{$book->author->name}}
            </td>

            <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500">
                {{\Carbon\Carbon::parse($book->published_at)->format('F j, y')}}
            </td>
            <td class="px-4 py-4 whitespace-nowrap text-right text-sm font-medium">

                <a href="{{route('manager.book.edit',$book->id)}}"
                    class="mr-4 text-indigo-600 hover:text-indigo-900"
                    id="edit-book-button" data-id="{{$book->id}}"
                    >Edit</a>

                    <a href="{{route('manager.book.destroy',$book->id)}}"
                        class="text-red-600 hover:text-red-600" id="delete-book" data-id="{{$book->id}}">Delete</a>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
</div>
{{-- @else
<p class=" inline-block flex justify-center rounded-full text-red-500 uppercase text-lg font-bold text-center">
    Sorry No Books ):
</p> --}}
</div>

</x-setting>

</main>
</section>
</div>
<script type="text/javascript">

    $('body').on('click','#manager-search',function(){
      event.preventDefault();
        console.log(event);
        axios.post('/manager/books', {search:$('#search').val()})
        .then(function(response){
            var data =  $(response.data).find("#tbody").html();
        $('#tbody').html(data);
            console.log(data);
        })
    })

    $('body').on('click','#create-book-form',function(){
        event.preventDefault();
        var image = document.querySelector('#image').files[0];
        axios.post("{{ route('manager.book.store') }}", {
            library_id: {{auth()->user()->library->id}},
            author_id: $('#author_id').find(":selected").val(),
            category_id: $('#category_id').find(":selected").val(),
            ispn: $('#ispn').val(),
            image: image,
            title: $('#title').val(),
            published_at: $('#published_at').val(),
        },
        {
         headers: {
            'Content-Type': 'multipart/form-data',
        }
    }
    )
        .then(function (response) {
          $('.alert-create-book').css("left","-36rem");
          console.log("success")
          var card = $('.books-tbody:first').prepend(`<tr class="item${response.data.message.id}">
            <td class="px-4 py-4 whitespace-nowrap">
            {{-- {{$loop->index+1}} --}} #
            </td>
            {{--<td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">--}}
            {{--    <img src="{{asset('storage/'. $book->image)}}" alt="Book Image">--}}
            {{--</td>--}}
            <td class="px-4 py-4 whitespace-nowrap">
            ${response.data.message.ispn}
            </td>
            <td class=" py-4 whitespace-nowrap">
            <span class="px-1 inline-flex text-sm leading-5 font-bold ">
            ${response.data.message.title}
            </span>
            </td>
            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">
            ${response.data.author}
            </td>

            <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500">
            {{\Carbon\Carbon::now()->format('F j, y')}}            </td>
            <td class="px-4 py-4 whitespace-nowrap text-right text-sm font-medium">

            <a href="/manager/books/edit/"+'${response.data.message.id}'
            class="mr-4 text-indigo-600 hover:text-indigo-900"
            id="edit-book-button" data-id="${response.data.message.id}"
            >Edit</a>

            <a href="/manager/books/destroy/"+'${response.data.message.id}'
            class="text-red-600 hover:text-red-600" id="delete-book" data-id="${response.data.message.id}">Delete</a>
            </td>
            </tr>`);
          console.log(response.data.message);
      }).catch(function(error){
        if(error.response.data.message){
            $("#ispn-errors").text('Duplicate ispn number enter unique one!')
        }
        if(error.response.data.errors['ispn']){
            $("#ispn-errors").text(error.response.data.errors['ispn'])
        }else{
            $("#ispn-errors").text('');
        }
        if(error.response.data.errors['title']){
            $("#title-errors").text(error.response.data.errors['title'])
        }else{
            $("#title-errors").text('')
        }
        if(error.response.data.errors['published_at']){
            $("#published_at-errors").text(error.response.data.errors['published_at'])
        }else{
            $("#published_at-errors").text('')
        }
        if(error.response.data.errors['author_id']){
            $("#author_id-errors").text(error.response.data.errors['author_id'])
        }
        if(error.response.data.errors['category_id']){
            $("#category_id-errors").text(error.response.data.errors['category_id'])
        }

    })
  });
    @if (isset($book))
    $('body').on('click','#delete-book',function(){
        let id = $(this).data('id')
        event.preventDefault();
        console.log(id)
        axios.get('/manager/books/destroy/'+id)
        .then(function(){
           console.log('book deleted successfully')
           $(".item"+id).empty();
       })
    })
    @endif
    document.getElementById('new-books').addEventListener("click",function(event){
        event.preventDefault();
        $('.alert-create-book').css('left','auto');
        $('#create-book-content').html(`  <x-panel>
         <form id="form-book"
         action="{{route('manager.book.store')}}"
         method="POST" enctype="multipart/form-data">
         @csrf
         <x-form.input name="ispn" type="number"></x-form.input>
         <x-form.input name="title" id="title-error"/>
         <x-form.label name="Author"></x-form.label>
         <select name="author_id" id="author_id" class=" mb-6 border border-gray-200 p-2 w-full rounded">
         @foreach($authors as $author)
         <option value="{{$author->id}}" >{{$author->name}}</option>
         @endforeach
         <x-form.errors name="author_id"/>
         <span id="author_id-errors" class="text-xs text-red-500"></span>

         </select>
         <x-form.label name="Category"></x-form.label>
         <select name="category_id" id="category_id" class=" mb-6 border border-gray-200 p-2 w-full rounded">
         @foreach($categories as $category)
         <option value="{{$category->id}}">{{$category->name}}</option>
         @endforeach
         <x-form.errors name="category_id" id="author-error"/>
         <span id="category_id-errors" class="text-xs text-red-500"></span>
         </select>
         <x-form.input name="image" type="file"/>
         <x-form.input name="published_at" type="date" id="published_at-error"/>
         <div class="flex items-center space-x-8">
         <x-form.button id="create-book-form">Create</x-form.button>
         <x-form.feild>
         <button id="cancle-button">Cancle</button>
         </x-form.feild>
         </div>
         </form>
         </x-panel>`)
    })
    $('body').on('click','#edit-book-button',function(){
        event.preventDefault();
        let id = $(this).data('id');
        console.log(id)
        axios.get('/manager/books/edit/'+id)
        .then(response =>{
            console.log(response.data.book)
            $('.alert-update-book').css('left','auto');
            $('#update-book-content').html(`<x-panel>
                <form
                action="/manager/books/update/"${response.data.book.id}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <x-form.input :value="old('ispn','${response.data.book.ispn}')" name="ispn" type="number"/>
                <x-form.input :value="old('title','${response.data.book.title}')" name="title"/>
                <x-form.label name="Author"></x-form.label>
                <select id="author_id" name="author_id" class=" mb-6 border border-gray-200 p-2 w-full rounded">
                @foreach($authors as $author)
                <option value="{{$author->id}}">{{$author->name}}</option>
                @endforeach
                <x-form.errors name=""/>
                </select>
                <select id="category_id" name="category_id" class=" mb-6 border border-gray-200 p-2 w-full rounded">
                <option selected value="{{$category->id}}">${response.data.book.category.name} </option>
                @foreach($categories as $category)
                <option @if('${response.data.book.category.name}' == $category->name ) ? selected : '' @endif  value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
                <x-form.errors name=""/>
                </select>
                <div class="flex  items-center mt-6 ">
                <div class="flex-1">
                <x-form.input name="image" type="file" :value="old('image','${response.data.book.image}')"/>
                </div>
                <img src="/img/book-cover6.jpg" alt="Post Image" height="50" width="50"
                class="ml-6">
                </div>
                <x-form.input :value="old('published_at','${response.data.book.published_at}')" name="published_at" type="date"/>
                <div class="flex items-center space-x-8">
                <x-form.button id="update-book-form" data-id="${response.data.book.id}">Update</x-form.button>
                <x-form.feild>
                <button id="cancle-button">Cancle</button>
                </x-form.feild>
                </div>
                </form>
                </x-panel>`)
        })
    })

    $('body').on('click','#update-book-form',function(){
        event.preventDefault();
        let id = $(this).data('id');
        if(document.querySelector('#image').files[0] != null){
            var image = document.querySelector('#image').files[0];
        }else{
            var image = '';
        }


        const data = new FormData();

        data.append("library_id", {{auth()->user()->library->id}});
        data.append("author_id", $('#author_id').find(":selected").val());
        data.append("category_id", $('#category_id').find(":selected").val());
        data.append("ispn", $('#ispn').val());
        data.append("image", image);
        data.append("title", $('#title').val());
        data.append("published_at", $('#published_at').val());

        axios.post("/manager/books/update/"+id, data ,
        {
         headers: {
            'Content-Type': 'multipart/form-data',
        }
    }
    )
        .then(function (response) {
            console.log(response.data.author)
          $('.alert-update-book').css("left","-36rem");
          $(".item"+id).html(`<td class="px-4 py-4 whitespace-nowrap">
            #
            </td>
            {{--<td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">--}}
            {{--    <img src="{{asset('storage/'. $book->image)}}" alt="Book Image">--}}
            {{--</td>--}}
            <td class="px-4 py-4 whitespace-nowrap">
            ${response.data.request.ispn}
            </td>
            <td class=" py-4 whitespace-nowrap">
            <span class="px-1 inline-flex text-sm leading-5 font-bold ">
            ${response.data.request.title}
            </span>
            </td>
            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">
            ${response.data.author}
            </td>

            <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500">
            {{-- {{\Carbon\Carbon::parse($book->published_at)->format('F j, y')}} --}}
            ${response.data.request.published_at}
            </td>
            <td class="px-4 py-4 whitespace-nowrap text-right text-sm font-medium">

            <a href="/manager/books/edit/"+'${response.data.id}'
            class="mr-4 text-indigo-600 hover:text-indigo-900"
            id="edit-book-button" data-id="${response.data.id}"
            >Edit</a>

            <a href="/manager/books/destroy/"+'${response.data.id}'
            class="text-red-600 hover:text-red-600" id="delete-book" data-id="${response.data.id}">Delete</a>
            </td>`);
          console.log("success")

      }).catch(function(error){
          if(error.response.data.message){
            $("#ispn-errors").text('Duplicate ispn number enter unique one!')
        }
        if(error.response.data.errors['ispn']){
            $("#ispn-errors").text(error.response.data.errors['ispn'])
        }else{
            $("#ispn-errors").text('');
        }
        if(error.response.data.errors['title']){
            $("#title-errors").text(error.response.data.errors['title'])
        }else{
            $("#title-errors").text('')
        }
        if(error.response.data.errors['published_at']){
            $("#published_at-errors").text(error.response.data.errors['published_at'])
        }else{
            $("#published_at-errors").text('')
        }
        if(error.response.data.errors['author_id']){
            $("#author_id-errors").text(error.response.data.errors['author_id'])
        }
        if(error.response.data.errors['category_id']){
            $("#category_id-errors").text(error.response.data.errors['category_id'])
        }

    })
  });

    $('body').on('click','#cancle-button',function(){
        event.preventDefault();
        $('.alert-create-book').css("left","-36rem");
        $('.alert-update-book').css("left","-36rem");
    })
</script>
</div>
 {{-- $("#form-book").validate({
            rules:{
              ispn: {
                  required:true,
                  maxlength : 13,
                  minlength : 13,
                  unique: true,
              },
              title: "required",
              author_id: "required",
              category_id: "required",
              published_at: "required",
          },
          messages:{
              ispn: {
                required:"pleas enter the ispn ",
                maxlength : "the ispn must not be greater than 13 characters ",
                minlength : "the ispn must not be less than 13 characters ",
                unique: "the ispn must not be unique",
            },
            title: "pleas enter the title",
            author_id: "pleas choose the author",
            category_id: "please choose the category",
            published_at: "please enter the date",
        },
    }) --}}

</x-app-layout>
