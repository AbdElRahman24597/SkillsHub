<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>@yield('title') - Dashboard - {{ env('APP_NAME') }}</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ dashboard_asset('css/fontawesome.all.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ dashboard_asset('css/adminlte.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    @yield('styles')

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <form method="post" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="nav-link btn">
                        <i class="fas fa-sign-out-alt"></i>
                        Logout
                    </button>
                </form>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{ route('home.index') }}" class="brand-link">
            <img src="{{ dashboard_asset('img/logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">SkillsHub</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ uploads(auth()->user()->avatar) }}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="{{ route('profile.index') }}" class="d-block">{{ auth()->user()->username }}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="{{ route('dashboard.home.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('dashboard.categories.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-list"></i>
                            <p>Categories</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('dashboard.skills.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-brain"></i>
                            <p>Skills</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('dashboard.exams.index') }}" class="nav-link">
                            <i class="nav-icon far fa-clipboard"></i>
                            <p>Exams</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('dashboard.students.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-user-graduate"></i>
                            <p>Students</p>
                        </a>
                    </li>
                    @if(auth()->user()->hasRole('admin'))
                        <li class="nav-item">
                            <a href="{{ route('dashboard.admins.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-user-cog"></i>
                                <p>Admins</p>
                            </a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a href="{{ route('dashboard.messages.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-envelope"></i>
                            <p>Messages</p>
                        </a>
                    </li>
                    @if(auth()->user()->hasRole('admin'))
                        <li class="nav-item">
                            <a href="{{ route('dashboard.settings.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-cogs"></i>
                                <p>Settings</p>
                            </a>
                        </li>
                    @endif
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

@yield('content')


<!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">
            {{ env('APP_NAME') }}
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2014-{{ \Carbon\Carbon::now()->year }} <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ dashboard_asset('js/jquery.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ dashboard_asset('js/bootstrap.bundle.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ dashboard_asset('js/adminlte.js') }}"></script>

@yield('scripts')

</body>
</html>
