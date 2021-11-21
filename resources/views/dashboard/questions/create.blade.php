@extends('layouts.dashboard')

@section('title')
    Add new exam (step 2) - Exams
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Add new exam (step 2)</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.home.index') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.exams.index') }}">Exams</a></li>
                            <li class="breadcrumb-item active">Create (step 2)</li>
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
                            <form method="post" action="{{ route('dashboard.exams.questions.store', $examId) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    @for($i = 0; $i < $questionsNumber; $i++)
                                        <h5>Question {{ $i + 1 }}</h5>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="Title">Title</label>
                                                    <input id="Title" class="form-control @error('titles.' . $i) is-invalid @enderror" name="titles[]" type="text" placeholder="Title" value="{{ old('titles.' . $i) }}">
                                                    @error('titles.' . $i)
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="RightAnswer">Right answer</label>
                                                    <input id="RightAnswer" class="form-control @error('right_answers.' . $i) is-invalid @enderror" name="right_answers[]" type="number" placeholder="Right answer" value="{{ old('right_answers.' . $i) }}" min="1" max="4">
                                                    @error('right_answers.' . $i)
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="Option1">Option 1</label>
                                                    <input id="Option1" class="form-control @error('option_1s.' . $i) is-invalid @enderror" name="option_1s[]" type="text" placeholder="Option 1" value="{{ old('option_1s.' . $i) }}">
                                                    @error('option_1s.' . $i)
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="Option2">Option 2</label>
                                                    <input id="Option2" class="form-control @error('option_2s.' . $i) is-invalid @enderror" name="option_2s[]" type="text" placeholder="Option 2" value="{{ old('option_2s.' . $i) }}">
                                                    @error('option_2s.' . $i)
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="Option3">Option 3</label>
                                                    <input id="Option3" class="form-control @error('option_3s.' . $i) is-invalid @enderror" name="option_3s[]" type="text" placeholder="Option 3" value="{{ old('option_3s.' . $i) }}">
                                                    @error('option_3s.' . $i)
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="Option4">Option 4</label>
                                                    <input id="Option4" class="form-control @error('option_4s.' . $i) is-invalid @enderror" name="option_4s[]" type="text" placeholder="Option 4" value="{{ old('option_4s.' . $i) }}">
                                                    @error('option_4s.' . $i)
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Create</button>
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
