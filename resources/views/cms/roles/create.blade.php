@extends('cms.parent')


@section('title', __('cms.create_role'))
@section('page-lg', __('cms.roles'))
@section('main-page-md', 'CMS')
@section('page-md', __('cms.create_role'))


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
                            <h3 class="card-title">{{ __('cms.create_role') }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->

                        <form id="create_form">
                            @csrf

                            <div class="card-body">

                                <div class="form-group">
                                    <label>{{ __('cms.user_type') }}</label>
                                    <select class="form-control" id="guard_name">
                                        <option value="admin">{{ __('cms.admin') }}</option>
                                        <option value="user">{{ __('cms.user') }}</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="name">{{ __('cms.name') }}</label>
                                    <input type="text" class="form-control" id="name"
                                        placeholder="{{ __('cms.name') }}">
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="button" onclick="performStore()"
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
        function performStore() {
            //application/x-www-form-urlencoded
            // axios.post('{{ route('users.store') }}', {
            axios.post('/cms/admin/roles', {
                    name: document.getElementById('name').value,
                    guard_name: document.getElementById('guard_name').value,
                })
                .then(function(response) {
                    console.log(response);
                    toastr.success(response.data.message);
                    document.getElementById('create_form').reset();
                })
                .catch(function(error) {
                    console.log(error);
                    toastr.error(error.response.data.message);
                });
        }
    </script>
@endsection
