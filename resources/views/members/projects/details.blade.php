@extends('layouts.index')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Project Detail</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('projects.index') }}">Manage Projects</a></li>
                            <li class="breadcrumb-item active">Project Detail</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Projects Detail</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fas fa-times"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Start Date</span>
                                            <span class="info-box-number text-center text-muted mb-0">{{ date('H:i d-m-Y', strtotime($project->begin_at)) }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">End Date</span>
                                            <span class="info-box-number text-center text-muted mb-0">{{ date('H:i d-m-Y', strtotime($project->finish_at)) }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Process</span>
                                            <span class="info-box-number text-center text-muted mb-0">{{ $process }}%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <h4>Projects Details</h4>
                                    <div class="post">
                                        <div class="mb-2">
                                            <strong>Title Project</strong>
                                        </div>
                                        <p>
                                            {{ $project->title }}
                                        </p>
                                    </div>

                                    <div class="post clearfix">
                                        <div class="mb-2">
                                            <strong>Project Description</strong>
                                        </div>
                                        <p>
                                            {{ $project->description }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                            <h3 class="text-primary"><i class="fas fa-paint-brush"></i>Additional Information</h3>
                            <br>
                            <div class="text-muted">
                                <p class="text-sm">Customer
                                    <b class="d-block">{{ $customer->full_name }}</b>
                                </p>
                                <p class="text-sm">Team members
                                    @foreach($member as $member)
                                        @if($member->email != auth()->user()->email)
                                            <b class="d-block mb-2">- &nbsp {{ $member->name }}</b>
                                        @else
                                            <b class="d-block mb-2">- &nbsp You
                                                ( <text class="text-red">{{ $member->name }}</text> )
                                            </b>
                                        @endif
                                    @endforeach
                                </p>
                                </br>
                                <p class="text-sm">
                                    <a class="btn btn-primary text-white"
                                       href="{{ route('tasks.show_task', $project->id) }}">List of Tasks</a>
                                    <a class="btn btn-secondary text-white" href="{{ route('projects.index') }}">Back to Projects</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
@endsection
