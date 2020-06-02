@extends('layouts.index')

@section('content')
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-8">
                            <h1>Result of Searching: "{{ request('search') }}"</h1>
                        </div>
                        <div class="col-sm-4">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Result of Searching</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
                <div class="row">
                    <!-- /.col -->
                    <div class="col-md-12">
                        <!-- Box Comment -->
                        <div class="card card-widget">
                            <div class="card-header">
                                <!-- /.user-block -->
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            @foreach($tasks as $task)
                                <div class="card-body">
                                    <!-- Attachment -->
                                    <div class="attachment-block clearfix">
                                        <div class="attachment">
                                            <h4>{{ $task->title }}</h4>

                                            <div class="description">
                                                {{ $task->description }}
                                            </div>
                                            <!-- /.attachment-text -->
                                        </div>
                                        <!-- /.attachment-pushed -->
                                    </div>
                                    <!-- /.attachment-block -->

                                    <!-- Social sharing buttons -->
                                    <a type="button" class="btn btn-primary text-white" href="{{ route('projects.show', $task->project_id) }}">
                                        View Project
                                    </a>
                                </div>
                            @endforeach
                            <div class="text-center">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-center">
                                        {{ $tasks->appends(request()->all())->links() }}
                                    </ul>
                                </nav>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->

        <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
            <i class="fas fa-chevron-up"></i>
        </a>
    </div>
@endsection
