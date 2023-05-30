<x-guest-layout>
    <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 mt-10">
        <a href="/">
            <x-application-logo class="w-20 h-20 fill-current text-gray-500"/>
        </a>
    </div>


    <form method="POST" action="{{ route('password.update') }}">
    @csrf

    <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <x-form.input name="email" type="email" :value="old('email', $request->email)" required
                      autofocus/>

        <x-form.input name="password" type="password"/>
        <x-form.input name="password_confirmation" type="password"/>
        <x-form.button> {{ __('Reset Password') }}</x-form.button>


    </form>
</x-guest-layout>
