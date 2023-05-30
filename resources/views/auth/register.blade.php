<x-app-layout>

<div id="render">
    <main class=" max-w-xl mx-auto mt-5 ">

        <x-panel>


            <h1 class="text-center font-bold text-xl">Register!</h1>
            <form class="mt-10"
                  action="{{route('register')}}"
                  method="POST">
                @csrf

                <x-form.input name="name"/>
                <x-form.input name="username"/>
                <x-form.input name="email" type="email"/>
                <x-form.input name="password" type="password"/>
                <x-form.input name="password_confirmation" type="password"/>
                <x-form.button>Register</x-form.button>

            </form>
        </x-panel>
    </main>
    {{--        <form method="POST" action="{{ route('register') }}">--}}
    {{--        @csrf--}}

    {{--        <!-- Name -->--}}
    {{--            <div>--}}
    {{--                <x-label for="name" :value="__('Name')"/>--}}

    {{--                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required--}}
    {{--                         autofocus/>--}}
    {{--            </div>--}}

    {{--            <!-- Username -->--}}
    {{--            <div class="mt-4">--}}
    {{--                <x-label for="username" :value="__('Username')"/>--}}

    {{--                <x-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')"--}}
    {{--                         required--}}
    {{--                         autofocus/>--}}
    {{--            </div>--}}
    {{--            <!-- Email Address -->--}}
    {{--            <div class="mt-4">--}}
    {{--                <x-label for="email" :value="__('Email')"/>--}}

    {{--                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required/>--}}
    {{--            </div>--}}

    {{--            <!-- Password -->--}}
    {{--            <div class="mt-4">--}}
    {{--                <x-label for="password" :value="__('Password')"/>--}}

    {{--                <x-input id="password" class="block mt-1 w-full"--}}
    {{--                         type="password"--}}
    {{--                         name="password"--}}
    {{--                         required autocomplete="new-password"/>--}}
    {{--            </div>--}}

    {{--            <!-- Confirm Password -->--}}
    {{--            <div class="mt-4">--}}
    {{--                <x-label for="password_confirmation" :value="__('Confirm Password')"/>--}}

    {{--                <x-input id="password_confirmation" class="block mt-1 w-full"--}}
    {{--                         type="password"--}}
    {{--                         name="password_confirmation" required/>--}}
    {{--            </div>--}}

    {{--            <div class="flex items-center justify-end mt-4">--}}
    {{--                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">--}}
    {{--                    {{ __('Already registered?') }}--}}
    {{--                </a>--}}

    {{--                <x-button class="ml-4">--}}
    {{--                    {{ __('Register') }}--}}
    {{--                </x-button>--}}
    {{--            </div>--}}
    {{--        </form>--}}
    {{--    </x-auth-card>--}}
</div>
</x-app-layout>
