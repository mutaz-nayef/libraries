@extends('cms.auth.auth-parent')
@section('title')
    Forget Password
@endsection
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="../../index2.html" class="h1"><b>Admin</b>LTE</a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>
            <form>
                <div class="input-group mb-3">
                    <input type="email" id="email" class="form-control" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="button" onclick="performForgetPassword()" class="btn btn-primary btn-block">Request
                            new password</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <p class="mt-3 mb-1">
                <a href="{{ route('cms.login', 'admin') }}">Back to Login</a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
@endsection
<!-- /.login-box -->
<!-- jQuery -->

@section('script')
    <script>
        function performForgetPassword() {

            axios.post('/cms/forget-password', {
                    email: document.getElementById('email').value,
                })
                .then(function(response) {
                    console.log(response);
                    window.location.href = "/cms/admin" // don't forget to put / before the url
                    toastr.success(response.data.message);
                })
                .catch(function(error) {
                    console.log(error);
                    toastr.error(error.response.data.message);
                });
        }
    </script>
@endsection
