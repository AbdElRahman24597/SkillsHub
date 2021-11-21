@extends('layouts.dashboard')

@section('title')
    Admins
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Admins</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.home.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Admins</li>
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
                                <h3 class="card-title">All admins</h3>
                                <div class="card-tools">
                                    <a href="{{ route('dashboard.admins.create') }}" class="btn btn-sm btn-primary">Add new admin</a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Role</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($admins as $admin)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $admin->username }}</td>
                                            <td>{{ $admin->email }}</td>
                                            <td>
                                                @if($admin->email_verified_at !== null)
                                                    <span class="badge bg-success">Verified</span>
                                                @else
                                                    <span class="badge bg-danger">Unverified</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge bg-warning">{{ $admin->getRoleNames()[0] }}</span>
                                                {{--@foreach($admin->getRoleNames() as $role)
                                                    <span class="badge bg-secondary">{{ $role }}</span>
                                                @endforeach--}}
                                            </td>
                                            <td>
                                                @if($admin->hasRole('admin'))
                                                    <form method="post" action="{{ route('dashboard.admins.demote', $admin->id) }}">
                                                        @method('patch')
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-secondary"><i class="fas fa-level-down-alt"></i></button>
                                                    </form>
                                                @else
                                                    <form method="post" action="{{ route('dashboard.admins.promote', $admin->id) }}">
                                                        @method('patch')
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-level-up-alt"></i></button>
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
                            {{ $admins->links('includes.paginator.dashboard') }}
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
