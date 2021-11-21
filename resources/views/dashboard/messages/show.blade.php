@extends('layouts.dashboard')

@section('title')
    {{ $message->subject }} - Messages
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">{{ $message->subject }}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.home.index') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.messages.index') }}">Messages</a></li>
                            <li class="breadcrumb-item active">Message</li>
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
                                        <th>Name</th>
                                        <td>{{ $message->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $message->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Subject</th>
                                        <td>{{ $message->subject }}</td>
                                    </tr>
                                    <tr>
                                        <th>Body</th>
                                        <td>{{ $message->body }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>
                                            @if($message->replied)
                                                <span class="badge bg-success">Replied</span>
                                            @else
                                                <span class="badge bg-danger">Unreplied</span>
                                            @endif
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                        @if(!$message->replied)
                            <div class="card">
                                <!-- form start -->
                                <form method="post" action="{{ route('dashboard.messages.reply', $message->id) }}">
                                    @csrf
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="Title">Title</label>
                                                    <input id="Title" class="form-control @error('title') is-invalid @enderror" name="title" type="text" placeholder="Title" value="{{ old('title') }}">
                                                    @error('title')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="Body">Body</label>
                                                    <textarea id="Body" class="form-control @error('body') is-invalid @enderror" name="body" placeholder="Body" cols="30" rows="10">{{ old('body') }}</textarea>
                                                    @error('body')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Reply</button>
                                    </div>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
