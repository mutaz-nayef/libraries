@extends('cms.parent')


@section('title', 'Cities')
@section('page-lg', 'Index')
@section('main-page-md', 'CMS-Cities')
@section('page-md', 'Index')


@section('sytels')

@endsection

@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('cms.cities') }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>{{ __('cms.name_en') }}</th>
                                        <th>{{ __('cms.name_ar') }}</th>
                                        <th>{{ __('cms.users') }}</th>
                                        <th>{{ __('cms.active') }}</th>
                                        <th>{{ __('cms.created_at') }}</th>
                                        <th>{{ __('cms.updated_at') }}</th>
                                        <th style="width: 40px">{{ __('cms.settings') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cities as $city)
                                        <tr>
                                            <td>{{ $city->id }}</td>
                                            <td>{{ $city->name_en }}</td>
                                            <td>{{ $city->name_ar }}</td>

                                            <td><span class="badge  bg-success ">{{ $city->users_count }}</span>
                                            <td><span
                                                    class="badge @if ($city->active) bg-success @else bg-danger @endif">{{ $city->active_status }}</span>
                                            </td>
                                            </td>
                                            <td>{{ $city->created_at }}</td>
                                            <td>{{ $city->updated_at }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    @can('Update_City')
                                                        <a href="{{ route('cities.edit', $city) }}" class="btn btn-info">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    @endcan
                                                    @can('Delete_City')
                                                        <form action="{{ route('cities.destroy', $city) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
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


@endsection
