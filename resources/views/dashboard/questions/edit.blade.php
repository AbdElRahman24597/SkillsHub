@extends('layouts.dashboard')

@section('title')
    Edit {{ $question->title }} - Questions - Exams
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Edit {{ $question->title }}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.home.index') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.exams.index') }}">Exams</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.exams.show', $question->exam->id) }}">{{ $question->exam->name }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.exams.questions.index', $question->exam->id) }}">Questions</a></li>
                            <li class="breadcrumb-item active">Edit</li>
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
                            <!-- form start -->
                            <form method="post" action="{{ route('dashboard.questions.update', $question->id) }}">
                                @method('patch')
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="Title">Title</label>
                                                <input id="Title" class="form-control @error('title') is-invalid @enderror" name="title" type="text" placeholder="Title" value="{{ old('title', $question->title) }}">
                                                @error('title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="RightAnswer">Right answer</label>
                                                <input id="RightAnswer" class="form-control @error('right_answer') is-invalid @enderror" name="right_answer" type="number" placeholder="Right answer" value="{{ old('right_answer', $question->right_answer) }}" min="1" max="4">
                                                @error('right_answer')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="Option1">Option 1</label>
                                                <input id="Option1" class="form-control @error('option_1') is-invalid @enderror" name="option_1" type="text" placeholder="Option 1" value="{{ old('option_1', $question->option_1) }}">
                                                @error('option_1')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="Option2">Option 2</label>
                                                <input id="Option2" class="form-control @error('option_2') is-invalid @enderror" name="option_2" type="text" placeholder="Option 2" value="{{ old('option_2', $question->option_2) }}">
                                                @error('option_2')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="Option3">Option 3</label>
                                                <input id="Option3" class="form-control @error('option_3') is-invalid @enderror" name="option_3" type="text" placeholder="Option 3" value="{{ old('option_3', $question->option_3) }}">
                                                @error('option_3')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="Option4">Option 4</label>
                                                <input id="Option4" class="form-control @error('option_4') is-invalid @enderror" name="option_4" type="text" placeholder="Option 4" value="{{ old('option_4', $question->option_4) }}">
                                                @error('option_4')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="{{ url()->previous() }}" class="btn btn-danger">Back</a>
                                </div>
                            </form>
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
