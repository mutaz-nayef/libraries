@extends('cms.parent')


@section('title', __('cms.users'))
@section('page-lg', __('cms.index'))
@section('main-page-md', __('cms.users'))
@section('page-md', __('cms.index'))


@section('sytels')

@endsection

@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('cms.users') }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>{{ __('cms.name') }}</th>
                                        <th>{{ __('cms.email') }}</th>
                                        <th>{{ __('cms.city') }}</th>
                                        <th>{{ __('cms.permissions') }}</th>
                                        <th>{{ __('cms.created_at') }}</th>
                                        <th>{{ __('cms.updated_at') }}</th>
                                        <th style="width: 40px">{{ __('cms.settings') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->city->name_en }}</td>
                                            <td>
                                                <a
                                                    href="{{ route('user.edit.permissions', $user->id) }}"class="btn btn-app bg-info">
                                                    <span
                                                        class="badge text-sm bg-danger">{{ $user->permissions_count }}</span>
                                                    <i class="fas fa-user-secret"></i>
                                                    {{ __('cms.permissions') }}
                                                </a>
                                            </td>
                                            <td>{{ $user->created_at }}</td>
                                            <td>{{ $user->updated_at }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    @can('Update_User')
                                                        <a href="{{ route('users.edit', $user) }}" class="btn btn-info">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    @endcan
                                                    @can('Delete_User')
                                                        <a href="#" onclick="confirmDelete('{{ $user->id }}',this)"
                                                            class="btn btn-danger">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    @endcan

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
        function confirmDelete(id, reference) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    performDelete(id, reference)
                }
            });
        }

        function performDelete(id, reference) {
            axios.delete('/cms/admin/users/' + id)
                .then(function(response) {
                    console.log(response)
                    reference.closest('tr').remove(); // give me the close tr for you then delete it 
                    showMessage(response.data)
                })
                .catch(function(error) {
                    console.log(error);
                    // toastr.error(error.response.data.message);
                    showMessage(error.response.data)

                });
        }

        function showMessage(data) {
            Swal.fire(
                data.title,
                data.text,
                data.icon
            );

        }
    </script>

@endsection
