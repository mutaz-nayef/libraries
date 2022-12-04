@extends('cms.parent')


@section('title', __('cms.permissions'))
@section('page-lg', 'Index')
@section('main-page-md', __('cms.permissions'))
@section('page-md', __('cms.permissions'))


@section('sytels')

@endsection

@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('cms.permissions') }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>{{ __('cms.name') }}</th>
                                        <th>{{ __('cms.user_type') }}</th>
                                        <th style="width: 40px">{{ __('cms.assigned') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permissions as $permission)
                                        <tr>
                                            <td>{{ $permission->name }}</td>
                                            <td><span class="badge  bg-success ">{{ $permission->guard_name }}</span></td>
                                            <td>

                                                <div class="form-group clearfix">
                                                    <div class="icheck-primary d-inline">
                                                        <input type="checkbox"
                                                            onclick="performUpdate('{{ $permission->id }}')"
                                                            id="checkboxPrimary{{ $permission->id }} "
                                                            @if ($permission->assigned) checked @endif>
                                                        <label for="checkboxPrimary{{ $permission->id }} ">
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->

        </div>
        <!-- /.row -->

        </div><!-- /.container-fluid -->
    </section>

@endsection


@section('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function performUpdate(permissionId) {

            axios.put('/cms/admin/roles/{{ $role->id }}/permissions/edit', {
                    permission_id: permissionId
                })
                .then(function(response) {
                    console.log(response.data.message)
                    toastr.success(response.data.message);
                })
                .catch(function(error) {
                    console.log(error);
                    toastr.error(error.response.data.message);

                });
        }
    </script>
@endsection
