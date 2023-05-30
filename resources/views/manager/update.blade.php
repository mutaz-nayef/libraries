<x-app-layout>
    <section class="px-6 py-8">

        <main class="max-w-6xl mx-auto mt-5 ">

            <x-setting heading="Update Book">
<div id="render">
                <x-panel>
                    <h1 class="text-center font-bold text-xl">Update Book!</h1>
                    <form class="mt-10"
                          action="/manager/books/update/{{$book->id}}"
                          method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <x-form.input :value="old('ispn',$book->ispn)" name="ispn" type="number"/>
                        <x-form.input :value="old('title',$book->title)" name="title"/>
                        <x-form.label name="Author"></x-form.label>
                        <select name="author_id" class=" mb-6 border border-gray-200 p-2 w-full rounded">
                            @foreach($authors as $author)
                                <option value="{{$author->id}}">{{$author->name}}</option>
                            @endforeach
                            <x-form.errors name="author_id"/>
                        </select>
                        <select name="category_id" class=" mb-6 border border-gray-200 p-2 w-full rounded">
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                            <x-form.errors name="category_id"/>
                        </select>

                        <div class="flex  items-center mt-6 ">
                            <div class="flex-1">
                                <x-form.input name="image" type="file" :value="old('image',$book->image)"/>
                                {{--                                <input type="file" name="image" value="{{$book->image}}">--}}

                            </div>
                            <img src="{{asset('storage/'. $book->image)}}" alt="Post Image" height="50" width="50"
                                 class="ml-6">
                        </div>
                        <x-form.input :value="old('published_at',$book->published_at)" name="published_at" type="date"/>
                        <x-form.button>Update</x-form.button>
                    </form>
                </x-panel>
            </div>
            </x-setting>
        </main>
    </section>

</x-app-layout>
