@extends('cms.parent')


@section('title', 'Temp')
@section('page-lg', __('cms.admin'))
@section('main-page-md', 'CMS')
@section('page-md', __('cms.edit_admin'))


@section('sytels')

@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('cms.edit_admin') }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->

                        <form id="update_form" enctype="application/x-www-form-urlencoded">
                            @csrf

                            <div class="card-body">
                                <div class="form-group">
                                    <label>{{ __('cms.roles') }}</label>
                                    <select class="form-control" id="role_id">
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}"
                                                @if ($admin->roles) checked @endif>{{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="name">{{ __('cms.name') }}</label>
                                    <input type="text" class="form-control" id="name"
                                        placeholder="{{ __('cms.name') }}" value="{{ $admin->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="email">{{ __('cms.email') }}</label>
                                    <input type="email" class="form-control" value="{{ $admin->email }}" id="email"
                                        placeholder="{{ __('cms.email') }}">
                                </div>

                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="button" onclick="performUpdate()"
                                        class="btn btn-primary">{{ __('cms.save') }}</button>
                                </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection


@section('scripts')

    {{-- <script src="{{ asset('js/axios.js') }}"></script> --}}

    <script>
        function performUpdate() {
            //application/x-www-form-urlencoded
            // axios.post('{{ route('admins.store') }}', {
            axios.put('/cms/admin/admins/{{ $admin->id }}', {
                    name: document.getElementById('name').value,
                    email: document.getElementById('email').value,
                    role_id: document.getElementById('role_id').value,
                })
                .then(function(response) {
                    console.log(response);
                    toastr.success(response.data.message);
                    window.location.href = '/cms/admin/admins';
                })
                .catch(function(error) {
                    console.log(error);
                    toastr.error(error.response.data.message);
                });
        }
    </script>
@endsection
