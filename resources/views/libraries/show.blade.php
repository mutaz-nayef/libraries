<x-app-layout>
    <section id="render" class=" px-6 py-8">

        <div class=" max-w-6xl  mx-auto movie-info">
            <div class="container mx-auto px-4 py-16 flex flex-col  md:flex-row">
                <div class="mt-20 w-full">
                    <img src="/img/gallery-02.png" alt="Library" class=" rounded-xl">
                </div>

                <div class="flex flex-col justify-start lg:ml-32 md:ml-10 ">

                    <div class="hidden lg:flex justify-between pr-10 mb-5">
                        <a href="{{route('libraries.index')}}"
                           class="transition-colors duration-300 relative inline-flex items-center text-lg hover:text-blue-500">
                            <svg width="22" height="22" viewBox="0 0 22 22" class="mr-2">
                                <g fill="none" fill-rule="evenodd">
                                    <path stroke="#000" stroke-opacity=".012" stroke-width=".5" d="M21 1v20.16H.84V1z">
                                    </path>
                                    <path class="fill-current"
                                          d="M13.854 7.224l-3.847 3.856 3.847 3.856-1.184 1.184-5.04-5.04 5.04-5.04z">
                                    </path>
                                </g>
                            </svg>

                            Back to Libraries
                        </a>
                    </div>

                    <div class="flex items-center mb-5 space-x-8">

                        <h2 class="text-4xl  font-semibold">{{$library['name']}}</h2>
                        @auth
                            <x-like-library-button :library="$library"/>
                        @endauth
                    </div>
                    <div class="flex flex-wrap items-center text-gray-400 text-sm">
                        <svg class="fill-current text-yellow-500 w-4" viewBox="0 0 24 24">
                            <g data-name="Layer 2">
                                <path
                                    d="M17.56 21a1 1 0 01-.46-.11L12 18.22l-5.1 2.67a1 1 0 01-1.45-1.06l1-5.63-4.12-4a1 1 0 01-.25-1 1 1 0 01.81-.68l5.7-.83 2.51-5.13a1 1 0 011.8 0l2.54 5.12 5.7.83a1 1 0 01.81.68 1 1 0 01-.25 1l-4.12 4 1 5.63a1 1 0 01-.4 1 1 1 0 01-.62.18z"
                                    data-name="star"/>
                            </g>
                        </svg>
                        {{--                        <span class="ml-1">{{$book['vote_average'] * 10 . '%'}}</span>--}}
                        <span class="ml-1">78%</span>
                        <span class=" mx-2">|</span>
                        <span>{{$library->address}}</span>
                    </div>
                    <p class="text-gray-800 mt-8">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus adipisci aperiam architecto
                        asperiores commodi consequatur culpa debitis distinctio est expedita fugiat molestiae natus
                        numquam, obcaecati officia officiis quam quasi qui rem reprehenderit sit soluta vero voluptate?
                        Enim placeat praesentium reiciendis.
                    </p>
                    <p class="text-gray-800 mt-8 ">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus adipisci aperiam architecto
                        asperiores commodi consequatur culpa debitis distinctio est expedita fugiat molestiae natus
                        numquam, obcaecati officia officiis quam quasi qui rem reprehenderit sit soluta vero voluptate?
                        Enim placeat praesentium reiciendis.
                    </p>

                </div>
            </div>


            <h2 class="uppercase tracking-wider mt-10 text-blue-500 text-lg font-semibold">
                {{$library->name}}
            </h2>
            <div class="grid  sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach($library->books as $book)
                    <x-book-card :book="$book"/>
                @endforeach

            </div>

        </div>

    </section>

</x-app-layout>
