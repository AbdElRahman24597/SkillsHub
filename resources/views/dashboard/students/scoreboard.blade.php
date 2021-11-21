@extends('layouts.dashboard')

@section('title')
    {{ $student->username }} Scoreboard - Students
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">{{ $student->username }} Scoreboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.home.index') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.students.index') }}">Students</a></li>
                            <li class="breadcrumb-item active">Scoreboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                @include('includes.messages')
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Scores</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Exam</th>
                                        <th>Score (%)</th>
                                        <th>Time (minutes)</th>
                                        <th>At</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($exams as $exam)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <a href="{{ route('dashboard.exams.show', $exam->id) }}">{{ $exam->name }}</a>
                                            </td>
                                            <td>{{ $exam->pivot->score }}</td>
                                            <td>{{ $exam->pivot->time }}</td>
                                            <td>{{ $exam->pivot->updated_at }}</td>
                                            <td>
                                                <span class="badge bg-warning">{{ $exam->pivot->status }}</span>
                                            </td>
                                            <td>
                                                @if($exam->pivot->status == 'closed')
                                                    <form method="post" action="{{ route('dashboard.students.exams.open', [$student->id, $exam->id]) }}">
                                                        @method('patch')
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-lock-open"></i></button>
                                                    </form>
                                                @else
                                                    <form method="post" action="{{ route('dashboard.students.exams.close', [$student->id, $exam->id]) }}">
                                                        @method('patch')
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-lock"></i></button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <div class="d-flex my-3 justify-content-center">
                            {{ $exams->links('includes.paginator.dashboard') }}
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
