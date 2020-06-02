@extends('layouts.index')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Tasks Management</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('tasks.index') }}">Select Projects</a></li>
                            <li class="breadcrumb-item active">List Tasks</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid" id="taskDetail" style="display: none">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        View Tasks of Detail:
                        <a class="float-right btn btn-danger text-white closeTask">Close</a>
                    </div>
                    <div class="card-body" id="div_task">
                        <div class="post clearfix"></div>
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
                                <h3 class="card-title">Project's Viewing: {{ $dataTask['titleProject'] }}</h3>
                            </div>
                            <!-- /.card-header -->
                            @if(session('success'))
                                <div class="alert alert-success text-center">
                                    {{session('success')}}
                                </div>
                            @endif

                            @if(session('error'))
                                <div class="alert alert-danger text-center">
                                    {{session('error')}}
                                </div>
                            @endif

                            <div class="card-body table-responsive p-0">
                                <table class="table table-head-fixed text-wrap">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Start at</th>
                                        <th>Finish at</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody id="table_data">
                                    @foreach($dataTask['listTask'] as $key => $value)
                                        <tr>
                                            <td>
                                                @if(request('page') > 1)
                                                    {{ ++$dataTask['paginate'] }}
                                                @else
                                                    {{ $key + 1 }}
                                                @endif
                                            </td>
                                            <td>{{ $value->title }}</td>
                                            <td>{{ date('H:i d-m-Y', strtotime($value->begin_at)) }}</td>
                                            <td>{{ date('H:i d-m-Y', strtotime($value->finish_at)) }}</td>
                                            <td>
                                                @if($value->status == \App\Models\Member::STATUS_ACTIVE)
                                                    <p class="alert alert-success p-1 text-center">Pending</p>
                                                @else
                                                    <p class="alert alert-danger p-1 text-center">Completed</p>
                                                @endif
                                            </td>
                                            <td>
                                                <a class="btn btn-primary viewTask text-white"
                                                   data-id="{{ $value->id }}"
                                                   data-title="{{ $value->title }}"
                                                   data-description="{{ $value->description }}"
                                                   data-time-begin="{{ date('H:i d-m-Y', strtotime($value->begin_at)) }}"
                                                   data-time-finish="{{ date('H:i d-m-Y', strtotime($value->finish_at)) }}"
                                                   data-pending="{{ \App\Models\Member::STATUS_ACTIVE }}"
                                                   data-status="{{ $value->status }}"
                                                >
                                                    View
                                                </a>
                                                @if($value->status == \App\Models\Member::STATUS_ACTIVE)
                                                    <a class="btn btn-success text-white dataClass" data-toggle="modal"
                                                       data-target="#exampleModal" data-whatever="@mdo"
                                                       data-id="{{ $value->id }}" data-project-id="{{ $dataTask['project_id'] }}">Complete</a>
                                                @else
                                                    <a class="btn btn-secondary text-white" disabled>Complete</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="text-center">
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination justify-content-center">
                                            {{ $dataTask['listTask']->links() }}
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
        <!-- Modals Completed Tasks -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group alert alert-warning p-0">
                            <strong>
                                You must to ensure that this task is completed before you continue close the task!
                            </strong>
                        </div>
                    </div>
                    <form method="GET" action="{{ route('update', ['task_id', 'project_id']) }}">
                        <div class="modal-data">
                            <input type="text" name="task_id" id="TaskId" value="" hidden/>
                            <input type="text" name="project_id" id="projects" value="" hidden/>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary text-white" id="idTask">Continue</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Modal Completed Task -->
    </div>
@endsection
@section('script')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>
    <!-- Pass data from table to modal -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script type="text/javascript">
        var table_length = document.getElementById("table_data").rows.length;
        if (table_length <= 0) {
            swal({
                title: "Ummm!",
                text: "Sorry! No task for the project immediately!"
            });
        }

        function noDataAlert() {
            swal({
                text: "No task in the project immediately!",
                icon: "error",
                buttons: ['Yep'],
                dangerMode: true
            })
        }

        $(function () {
            $(".dataClass").click(function () {
                var taskId = $(this).data('id');
                var projectId = $(this).data('project-id');
                $(".modal-data #TaskId").val(taskId);
                $(".modal-data #projects").val(projectId);
            });
        });
        $(document).ready(function() {
            $('.viewTask').click(function() {
                var id = $(this).data('id');
                var title = $(this).data('title');
                var description = $(this).data('description');
                var timeBegin = $(this).data('time-begin');
                var finish = $(this).data('time-finish');
                var statusPending = $(this).data('pending');
                var statusTask = $(this).data('status');
                $("#taskDetail").show();
                $("html").animate({ scrollTop: 0 }, "slow");
                if (statusTask === statusPending) {
                    var status = '<strong class=\'text-danger\'>Pending</strong>';
                } else {
                    var status = '<strong class=\'text-success\'>Completed</strong>';
                };
                div_str = "<h4>" + title + "</h4>" +
                    "<div class=\"post clearfix\">" +
                    "<p> Description: " + "<strong>" + description + "</strong>" + "</p>" +
                    "<p> Status: " + status + "</p>" +
                    "<p> Start at: " + "<strong>" + timeBegin + "</strong>" + "</p>" +
                    "<p> End at: " + "<strong>" + finish + "</strong>" + "</p>" +
                    "</div>";

                $("#taskDetail #div_task").empty().append(div_str);
            });
            $('.closeTask').click(function() {
                $("#taskDetail").hide();
            });
        });
    </script>
    <!-- End pass data -->
@endsection
