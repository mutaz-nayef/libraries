<x-guest-layout>
    <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 mt-10">
        <a href="/">
            <x-application-logo class="w-20 h-20 fill-current text-gray-500"/>
        </a>
    </div>

    <div class="mb-4 text-sm text-gray-600">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>


    <form method="POST" action="{{ route('password.confirm') }}">
    @csrf

    <!-- Password -->
        <x-form.input name="password" type="password" autocomplete="current-password"/>
        <x-form.button>Log In</x-form.button>
        {{ __('Confirm') }}
    </form>
</x-guest-layout>
