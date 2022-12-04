@extends('cms.auth.auth-parent')
@section('title')
    Verify Email
@endsection
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="../../index2.html" class="h1"><b>Admin</b>LTE</a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>
            <form>
                <div class="input-group mb-3">
                    <input type="password" id="password" class="form-control" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" id="password_confirmation" class="form-control" placeholder="Confirm Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="button" onclick="performResetPassword()" class="btn btn-primary btn-block">Change
                            password</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <p class="mt-3 mb-1">
                <a href="{{ route('cms.login', 'admin') }}"> Back to Login</a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
@endsection
@section('script')
 
@endsection




{{-- <script>
    // function performResetPassword() {

   //     // axios.post('/cms/reset-password', {
   //     //         // token: '{{ $token }}',
   //     //         email: '{{ $email }}',
   //     //         password: document.getElementById('password').value,
   //     //         password_confirmation: document.getElementById('password_confirmation').value,

   //     //     })
   //     //     .then(function(response) {
   //     //         console.log(response);
   //     //         window.location.href = "/cms/admin/login" // don't forget to put / before the url
   //     //         toastr.success(response.data.message);
   //     //     })
   //     //     .catch(function(error) {
   //     //         console.log(error);
   //     //         toastr.error(error.response.data.message);
   //     //     });
   // }
</script> --}}