<nav x-data="{ open: false }"
class=" h-20 bg-white border-b border-gray-100">
<!-- Primary Navigation Menu -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-16">
        <div class="container mx-auto flex flex-col md:flex-row items-center justify-between px-4 lg:py-6">
            <!-- Logo -->
            <div class="shrink-0 flex justify-between items-center">
                <a id="app-logo" href="/">
                    <x-application-logo/>
                </a>
            </div>
            <div class=" lg:ml-5 flex items-center">

                @if (Route::has('login'))
                <div class="lg:mb-0 mb:10rounded-lg flex items-center sm:block">
                    @auth
                    <a href="/"
                    class=" w-fit bg-blue-500 uppercase text-white text-xs px-4 py-1 rounded-2xl font-semibold hover:bg-blue-600 transition ease-in-out duration-150 inline-block mt-1">
                    Subscribe
                </a>
                @else
                <div class=" flex items-center">
                    <x-nav-link
                    href="/login" class="font-bold" id="login">Log In
                </x-nav-link>
                <x-nav-link
                href="/register" class="font-bold"  id="register">Register
            </x-nav-link>
        </div>

        @endauth
    </div>
    @endif
</div>


<!-- Navigation Links -->
<div class=" hidden space-x-8 sm:-my-px  sm:flex">
    @admin
    <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="nav-link" >
        {{ __('Dashboard') }}
    </x-nav-link>
    @endadmin

    @manager
    <x-nav-link :href="route('manager.books')" :active="request()->routeIs('manager.books')"
        id="manager-books" class="nav-link">
        {{ __('Book Manager') }}
    </x-nav-link>
    @endmanager


    <x-nav-link href="/" :active="request()->routeIs('home')"
        id="home" class="nav-link">
        {{ __('Home') }}
    </x-nav-link>

    <x-nav-link href="{{route('libraries.index')}}" :active="request()->routeIs('libraries.index')" id="libraries-nav" class="nav-link">
        {{ __('Libraries') }}
    </x-nav-link>
    <x-nav-link href="/books" :active="request()->routeIs('books.index')" class="nav-link" id="books-main">
        {{ __('Books') }}
    </x-nav-link>
    <x-nav-link href="/authors" :active="request()->routeIs('authors.index')" id="authors-nav" class="nav-link">
        {{ __('Authors') }}
    </x-nav-link>
</div>

<div class="inline-flex sm:block relative text-sm mx-auto">
    <livewire:search-dropdown/>
</div>
</div>

<!-- Settings Dropdown -->


@auth
<div class="hidden sm:flex sm:items-center sm:ml-6">
    <x-dropdown align="right" width="48">
        <x-slot name="trigger">
            <button
            class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
            <div>{{ Auth::user()->name }}</div>

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
    <!-- Authentication -->
    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <x-dropdown-link :href="route('logout')"
        onclick="event.preventDefault();
        this.closest('form').submit();">
        {{ __('Log Out') }}
    </x-dropdown-link>
</form>
</x-slot>
</x-dropdown>
</div>

<!-- Hamburger -->
<div class="-mr-2 mb-20 flex items-center sm:hidden">
    <button @click="open = ! open"
    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
        stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M4 6h16M4 12h16M4 18h16"/>
        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
        stroke-linecap="round"
        stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
    </svg>
</button>
</div>
</div>
</div>

<!-- Responsive Navigation Menu -->
<div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden sm:mb-20">

    <div class="pt-2 pb-3 space-y-1">
        @admin
        <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
            {{ __('Dashboard') }}
        </x-responsive-nav-link>
        @endadmin

        @manager
        <x-responsive-nav-link :href="route('manager.books')" :active="request()->routeIs('manager.books')">
            {{ __('Books') }}
        </x-responsive-nav-link>
        @endmanager

        <x-responsive-nav-link href="/" :active="request()->routeIs('home')">
            {{ __('Home') }}
        </x-responsive-nav-link>

        <x-responsive-nav-link href="{{route('libraries.index')}}" :active="request()->routeIs('libraries.index')">
            {{ __('Libraries') }}
        </x-responsive-nav-link>
        <x-responsive-nav-link href="/books" :active="request()->routeIs('books.index')"
            id="books-main">
            {{ __('Books') }}
        </x-responsive-nav-link>
        <x-responsive-nav-link href="/authors" :active="request()->routeIs('authors.index')">
            {{ __('Authors') }}
        </x-responsive-nav-link>


    </div>

    <!-- Responsive Settings Options -->
    <div class="pt-4 pb-1 border-t border-gray-200">
        <div class="px-4">
            <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
            <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
        </div>

        <div class="mt-3 space-y-1">
            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <x-responsive-nav-link :href="route('logout')"
                onclick="event.preventDefault();
                this.closest('form').submit();">
                {{ __('Log Out') }}
            </x-responsive-nav-link>
        </form>
    </div>
</div>

</div>
@endauth
</nav>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.27.2/axios.min.js"></script>
<script>
    @auth
    @else
//     $(document).ready(function(){
//  document.getElementById('login').addEventListener("click",function(event){
//     event.preventDefault();
//     axios.get("/login")
//     .then(function(response){
//  $('#body').html(response.data);
//     window.history.pushState("", "", "/login");
// })
// })
// document.getElementById('register').addEventListener("click",function(event){
//     event.preventDefault();
//     axios.get("/register")
//     .then(function(response){
//  $('#body').html(response.data);
//     window.history.pushState("", "", "/register");
// })

// })
//     });
    @endauth




</script>
