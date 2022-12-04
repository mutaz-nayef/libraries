@extends('cms.parent')


@section('title', __('cms.edit_role'))
@section('page-lg')
@section('main-page-md', __('cms.roles'))
@section('page-md', __('cms.edit_role'))


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
                            <h3 class="card-title">{{ __('cms.edit_role') }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->

                        <form id="update_form" enctype="application/x-www-form-urlencoded">
                            @csrf

                            <div class="card-body">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>{{ __('cms.user_type') }}</label>
                                        <select class="form-control" id="guard_name">
                                            <option value="admin" @if ($role->guard_name == 'admin') selected @endif>
                                                {{ __('cms.admin') }}
                                            </option>
                                            <option value="user"@if ($role->guard_name == 'user') selected @endif>
                                                {{ __('cms.user') }}
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name">{{ __('cms.name') }}</label>
                                    <input type="text" class="form-control" id="name"
                                        placeholder="{{ __('cms.name') }}" value="{{ $role->name }}">
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

    <script>
        function performUpdate() {
            //application/x-www-form-urlencoded
            // axios.post('{{ route('users.store') }}', {
            axios.put('/cms/admin/roles/{{ $role->id }}', {
                    name: document.getElementById('name').value,
                    guard_name: document.getElementById('guard_name').value,
                })
                .then(function(response) {
                    console.log(response);
                    toastr.success(response.data.message);
                    window.location.href = '/cms/admin/roles';
                })
                .catch(function(error) {
                    console.log(error);
                    toastr.error(error.response.data.message);
                });
        }
    </script>

@endsection
