@extends('layouts.dashboard')

@section('title')
    Settings
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Settings</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.home.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Settings</li>
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
                            <!-- form start -->
                            <form method="post" action="{{ route('dashboard.settings.update') }}">
                                @method('patch')
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="Email">Email</label>
                                                <input id="Email" class="form-control @error('email') is-invalid @enderror" name="email" type="email" placeholder="Email" value="{{ old('email', $setting->email) }}">
                                                @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="Phone">Phone</label>
                                                <input id="Phone" class="form-control @error('phone') is-invalid @enderror" name="phone" type="tel" placeholder="Phone" value="{{ old('phone', $setting->phone) }}">
                                                @error('phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="Facebook">Facebook</label>
                                                <input id="Facebook" class="form-control @error('facebook') is-invalid @enderror" name="facebook" type="url" placeholder="Facebook" value="{{ old('facebook', $setting->facebook) }}">
                                                @error('facebook')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="Twitter">Twitter</label>
                                                <input id="Twitter" class="form-control @error('twitter') is-invalid @enderror" name="twitter" type="url" placeholder="Twitter" value="{{ old('twitter', $setting->twitter) }}">
                                                @error('twitter')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="Instagram">Instagram</label>
                                                <input id="Instagram" class="form-control @error('instagram') is-invalid @enderror" name="instagram" type="url" placeholder="Instagram" value="{{ old('instagram', $setting->instagram) }}">
                                                @error('instagram')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="Youtube">Youtube</label>
                                                <input id="Youtube" class="form-control @error('youtube') is-invalid @enderror" name="youtube" type="url" placeholder="Youtube" value="{{ old('youtube', $setting->youtube) }}">
                                                @error('youtube')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="LinkedIn">LinkedIn</label>
                                                <input id="LinkedIn" class="form-control @error('linkedin') is-invalid @enderror" name="linkedin" type="url" placeholder="LinkedIn" value="{{ old('linkedin', $setting->linkedin) }}">
                                                @error('linkedin')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
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
