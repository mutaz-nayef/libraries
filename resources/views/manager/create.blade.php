<x-app-layout>
    <section class="px-6 py-8">

       <main class="max-w-6xl mx-auto mt-5 ">

            <x-setting heading="Create Book">
                <div id="render">

             <x-panel>
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
                <x-form.button>Create</x-form.button>
                <x-form.feild>
                    <button id="cancle-button">Cancle</button>
                </x-form.feild>
            </div>
        </form>
    </x-panel>
    </div>
            </x-setting>
        </main>
    </section>

</x-app-layout>
