@extends('layouts.dashboard')

@section('title')
    {{ $exam->name }} - Exam
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">{{ $exam->name }}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.home.index') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.exams.index') }}">Exams</a></li>
                            <li class="breadcrumb-item active">Exam</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <tbody>
                                    <tr>
                                        <th>Skill</th>
                                        <td>
                                            <a href="{{ route('dashboard.skills.show', $exam->skill->id) }}">{{ $exam->skill->name }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Name (en)</th>
                                        <td>{{ $exam->getTranslation('name', 'en') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Name (ar)</th>
                                        <td>{{ $exam->getTranslation('name', 'ar') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Description (en)</th>
                                        <td>{{ $exam->getTranslation('description', 'en') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Description (ar)</th>
                                        <td>{{ $exam->getTranslation('description', 'ar') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Image</th>
                                        <td>
                                            <a href="{{ uploads($exam->image) }}" target="_blank">
                                                <img src="{{ uploads($exam->image) }}" alt="{{ $exam->name }}" width="50" height="50">
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Questions (number)</th>
                                        <td>{{ $exam->questions_number }}</td>
                                    </tr>
                                    <tr>
                                        <th>Difficulty</th>
                                        <td>{{ $exam->difficulty }}</td>
                                    </tr>
                                    <tr>
                                        <th>Duration (minutes)</th>
                                        <td>{{ $exam->duration }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>
                                            @if($exam->active)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <a href="{{ route('dashboard.exams.questions.index', $exam->id) }}" class="btn btn-primary">Questions</a>
                                <a href="{{ url()->previous() }}" class="btn btn-danger">Back</a>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
