@extends('layouts.index')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>List Tasks by Project</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">List Tasks</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">All Projets is Pending</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-head-fixed text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title Project</th>
                                        <th>Time Begin</th>
                                        <th>Time Finish</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($selectProjects as $key => $selectProject)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $selectProject->title }}</td>
                                            <td>{{ date('H:i d-m-Y', strtotime($selectProject->begin_at)) }}</td>
                                            <td>{{ date('H:i d-m-Y', strtotime($selectProject->finish_at)) }}</td>
                                            <td>
                                                <a href="{{ route('tasks.show_task', $selectProject->id) }}" class="btn btn-success">view</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="text-center">
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination justify-content-center">
                                            {{ $selectProjects->links() }}
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
    </div>
@endsection
