<x-app-layout>
    <!-- Session Status -->

    <div id="render">

        <main class="max-w-lg mx-auto mt-10">
            <x-panel>
                <x-auth-session-status class="mb-4" :status="session('status')"/>
                <h1 class="text-center font-bold text-xl">Log In!</h1>
                <form class="mt-10"
                action="{{route('login')}}"
                method="POST">
                @csrf
                {{--                // cross site request forgery--}}

                <x-form.input name="email" type="email" autocomplete="username"/>
                <x-form.input name="password" type="password" autocomplete="new-password"/>

                <div class="flex items-center m-2">
                    <label for="remember_me" class="mr-5 inline-flex items-center">
                        <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        name="remember">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>

                    @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
                @endif
            </div>
            <x-form.button id="login-form">Log In</x-form.button>
        </form>
    </x-panel>
</main>
</div>

<script>
    // $('body').on('click','#login-form',function(){
    //     event.preventDefault();
    //     if ($('#email').val() != null && $('#password').val() != null ){
    //        window.history.pushState({}, "", '');
    //         axios.post('{{route("login.post")}}', {
    //         email: $('#email').val(),
    //         password: $('#password').val(),
    //     }).then(function(response){
    //        // var data =  $(response.data).find("#render").html();
    //        $('body').html(null);
    //        $('body').html(response.data);

    //        console.log("success")
       // });
    // }else{
        // console.log("error")
    // }
// })
</script>
</x-app-layout>

