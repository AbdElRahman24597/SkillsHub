@extends('layouts.web')

@section('title')
    @lang('web.profile.scoreboard.title') - @lang('web.profile.title')
@endsection

@section('content')
    <!-- Hero-area -->
    <div class="hero-area section">

        <!-- Backgound Image -->
        <div class="bg-image bg-parallax overlay" style="background-image:url({{ web_asset('img/page-background.jpg') }})"></div>
        <!-- /Backgound Image -->

        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 text-center">
                    <ul class="hero-area-tree">
                        <li><a href="{{ route('home.index') }}">@lang('web.general.home')</a></li>
                        <li><a href="{{ route('profile.index') }}">@lang('web.profile.title')</a></li>
                        <li>@lang('web.profile.scoreboard.title')</li>
                    </ul>
                    <h1 class="white-text">{{ auth()->user()->username }}</h1>

                </div>
            </div>
        </div>

    </div>
    <!-- /Hero-area -->

    <!-- Blog -->
    <div id="blog" class="section">

        <!-- container -->
        <div class="container">

            <!-- row -->
            <div class="row">

                <!-- main blog -->
                <div id="main" class="col-md-12">

                    <!-- blog post -->
                    <div class="blog-post mb-5">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('web.profile.scoreboard.name')</th>
                                <th>@lang('web.profile.scoreboard.score')</th>
                                <th>@lang('web.profile.scoreboard.time')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(auth()->user()->exams as $exam)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $exam->name }}</td>
                                    <td>{{ $exam->pivot->score }}</td>
                                    <td>{{ $exam->pivot->time }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /blog post -->

                </div>
                <!-- /main blog -->

            </div>
            <!-- row -->

        </div>
        <!-- container -->

    </div>
    <!-- /Blog -->
@endsection
