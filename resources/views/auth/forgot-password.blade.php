<x-guest-layout>
    <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 mt-10">
        <a href="/">
            <x-application-logo class="w-20 h-20 fill-current text-gray-500"/>
        </a>
    </div>

    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')"/>

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors"/>

    <form method="POST" action="{{ route('password.email') }}">
    @csrf

    <!-- Email Address -->
        <x-form.input name="email" type="email" :value="old('email')" required
                      autofocus/>


        <x-form.button>
            {{ __('Email Password Reset Link') }}
        </x-form.button>


    </form>
</x-guest-layout>
